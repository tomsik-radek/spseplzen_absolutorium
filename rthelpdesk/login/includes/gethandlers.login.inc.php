<?php
    if(isset($_GET["action"])){
        if($_GET["action"] === "login"){
            include("./includes/login.inc.php");
        }
        if($_GET["action"] === "register"){
            include("./includes/register.inc.php");
            echo "including register <br>";
        }
    }
    if(isset($_GET["error"])){
        if($_GET["error"] === "invalidmailorpassword"){
            echo("Invalid email or password");
        }
        if($_GET["error"] === "invalidmailformat"){
            echo("Entered email address is not valid");
        }
        if($_GET["error"] === "passwordsdontmatch"){
            echo("Entered passwords do not match");
        }
        if($_GET["error"] === "passwordrequirements"){
            echo("Entered passwords don not meet security requirements");
        }
        if($_GET["error"] === "useralreadyregistered"){
            echo("User with this email is already registered");
        }
        if($_GET["error"] === "catastrophic") {
            echo("Critical error occured when creating a user account. Please contact an administrator");
        }
        if($_GET["error"] === "regsuccess"){
            echo("Registration was completed successfully. <br> You can now log in");
        }
        if($_GET["error"] === "oldpswdisnewpass"){
            echo("New password can not be the same as old password");
        }
        if($_GET["error"] === "newpswdnotrequirs"){
            echo("New password doesn't meet security requirements");
        }
        if($_GET["error"] === "pswdnotmatch"){
            echo("Passwords do not match. Please try again");
        }
    }
?>