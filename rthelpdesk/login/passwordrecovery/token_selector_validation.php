<?php
    if (isset($_GET["token"]) && (isset($_GET["selector"]))) {
        $selector = $_GET["selector"];
        $token = $_GET["token"];
        /*echo("Selector: $selector <br>");
        echo("Token: $token <br>");
        */

        $domainfolder = "absolv2/";
        $url = "http://$_SERVER[HTTP_HOST]/" . $domainfolder . "login/?page=pswdrecoveryform&selector=$selector&token=$token";
        //echo $url . "<br>";
        $_SESSION["PassResetURL"] = $url;


        $token = hex2bin($token);
        $hashedToken = hash("sha256", $token);

        $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = ?;";
        include("../includes/connect.inc.php");
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$selector);
        if($stmt->execute()){
            //echo("sel success <br>");
        }else{
            //echo("sel fail <br>");
        }
        $stmt = $stmt->get_result();
        if(mysqli_num_rows($stmt) !== 0){
            while ($row = mysqli_fetch_assoc($stmt)) {
                $resetEmail = $row["pwdResetEmail"];
                //$_SESSION["passwordreset_email"] = $resetEmail;
                $tokendb = $row["pwdResetToken"];
                $expires = $row["pwdResetExpires"];
                /*echo "token expires at $expires <br>";
                echo "current unix time " . date("U") . "<br>";
                echo "Hashed token: $hashedToken <br>";
                echo "Tokendb: $tokendb <br>"; 
                */

                if ($expires > date("U")) {
                    //echo "not expired, continuing <br>";
                    if($hashedToken === $tokendb){
                        //echo "tokens match <br>";
                    }else{
                        header("location: ./?page=login&error=expired");
                        exit();
                    }
                } else {
                    header("location: ./?page=login&error=expired");
                    exit();
                    echo "token expired <br>";
                }
            }
        }else{
            header("location: ./?page=login&error=expired");
            exit();
        }
    }else{
        header("location: ./");
        exit();
    }
?>