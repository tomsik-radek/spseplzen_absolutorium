<?php
    echo "sending mail <br>";
    function generateSelector(){
        $selector = random_bytes(8);
        $selector = bin2hex($selector);
        return $selector;
    }

    function generateToken(){
        $token = random_bytes(32);
        $token = bin2hex($token);
        return $token;
    }

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_POST["inputemail"])){
        echo "inputemail " . $_POST["inputemail"] . "<br>";
        $inputemail = $_POST["inputemail"];
        if(isset($_GET["return"])){
            if($_GET["return"] == "admin"){
                include("../login/includes/functions.inc.php");
                include("../includes/connect.inc.php");
            }
        }else{
            include("./includes/functions.inc.php");
            include("../includes/connect.inc.php");
        }

        if(userExists($conn,$inputemail)){
            echo "user exists <br>";
            $selector = generateSelector();
            $token = generateToken();

            $host = $_SERVER["HTTP_HOST"];
            $host = $host . "/absolv2";
            $url = "https://$host/login/?page=pswdrecoveryform&selector=" . $selector . "&token=" . $token;
            echo "url: " . $url . "<br>";
            echo "host: " . $host . "<br>";

            $_SESSION["passwordrecoveryurl"] = $url;
            $mailRecipient = $inputemail;
            $mailSubject = "Password recovery request.";
            $filePath = "../phpmailer/messages/passwordrecovery.php";


            require_once("../phpmailer/includes/PHPMailer.php");
            require_once("../phpmailer/includes/SMTP.php");
            require_once("../phpmailer/includes/Exception.php");
            include("../phpmailer/includes/mailvars.php");
            include("../phpmailer/includes/functions.inc.php");
            include("../phpmailer/index.php");

            include("../includes/connect.inc.php");
            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s",$mailRecipient);
            if($stmt->execute()){
                echo("del success <br>");
            }else{
                echo("del fail <br>");
            }

            $expires = date("U") + 900;
            $hashedToken = hash('sha256', $token);
            echo "unhashed token $token <br>";
            echo "Hashed token: $hashedToken <br>";
            $sql = "INSERT INTO `pwdReset`(pwdResetEmail,pwdResetSelector,pwdResetToken,pwdResetExpires)
            VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssi",$mailRecipient,$selector,$hashedToken,$expires);
            if($stmt->execute()){
                echo("pwrins success <br>");
            }else{
                echo("pwrins fail <br>");
            }

            mysqli_close($conn);

            if (isset($_GET["return"])) {
                if(($_GET["return"]) == "admin"){
                    header("location: ../dashboard/?page=users&msg=emailsent");
                    exit();
                }
            }else{
                header("location: ../login/?page=passwordreset&msg=emailsent");
                exit();
            }
        }else{
            echo "user doesnt exist <br>";
            header("location: ../login/?page=passwordreset&msg=usernotexist");
            exit();
        }
    }
?>