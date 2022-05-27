<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$passResetURL = $_SESSION["PassResetURL"];
$email = $_POST["email"];
if(isset($_GET["page"])){
    if ($_GET["page"] === "pswdrecovery") {
        if (isset($_POST["password1"]) && (isset($_POST["password2"]))) {
            if ($_POST["password1"] === $_POST["password2"]) {
                echo("Changing password of " . $email . "<br>");
                echo("reset url: " . $_SESSION["PassResetURL"] . "<br>");
                include("./includes/functions.inc.php");
                include("../includes/connect.inc.php");
                $newPass = $_POST["password1"];
                if (pswdReqs($newPass)) {
                    $newPassHash = hash("sha256", $newPass);
                    if(pswdAlreadyExists($conn,$email,$newPassHash) === false){
                        echo $email . "<br>";
                        echo "old password doesn't match new password, continuing <br>";
                        $stmt = $conn->prepare("UPDATE users SET encPass=? WHERE email = ?");
                        $stmt->bind_param("ss", $newPassHash, $email);
                        $stmt->execute();
                        $stmt->close();
                        mysqli_close($conn);
        
                        echo "stmt executed <br>";
                        header("location: ./?page=login&msg=success");
                        exit();
                    } else {
                        mysqli_close($conn);
                        echo "new password = old password <br>";
                        $url = $passResetURL . "&error=oldpswdisnewpass";
                        header("location: " . $url);
                        exit();
                    }
                }else{
                    echo "new password doesn't meet requirements";
                    $url = $passResetURL . "&error=newpswdnotrequirs";
                    header("location: " . $url);
                    exit();
                }
            } else {
                $url = $passResetURL . "&error=pswdnotmatch";
                header("location: " . $url);
                exit();
                echo "ps not match <br>";
            }
        }
    }
}else{
    echo "invalid <br>";
    header("location: ./");
    exit();
}