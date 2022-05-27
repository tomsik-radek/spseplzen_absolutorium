<?php
    $debug = true;
    if(isset($_POST["inputemail"]) && (isset($_POST["inputpassword"]))){
        $inputemail = $_POST["inputemail"];
        $inputpassword = $_POST["inputpassword"];

        if ($debug === true) {
            echo $inputemail . "<br>";
            echo $inputpassword . "<br>";
        }

        include("../includes/functions.inc.php");
        require("./includes/functions.inc.php");
        require("../includes/connect.inc.php");

        //Checking for valid inputs
        //Does email meet requirements (format)
        if(isValidMail($inputemail) !== false){
            if($debug === true){
                echo "email is valid <br>";
            }
        }else{
            header("location: ./?error=invalidmailorpassword");
            exit();
        }

        //Does password meet requirements (lenght etc). No need to bother checking for validity if it is too short etc
        if(pswdReqs($inputpassword) !== false){   
            if($debug === true){
                echo "password meets requirements <br>";
            }
        }else{
            header("location: ./?error=invalidmailorpassword");
            exit();
        }

        //If logging of user was successfull set some basic parameters and redirect user to dashboard
        if(loginUser($conn, $inputemail, $inputpassword) !== false){
            echo "logging in <br>";
            require("../includes/connect.inc.php");
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
           
            loadUserPreferences($conn,$inputemail);
            echo("pref loaded <br>");
            mysqli_close($conn);
            
            header("location: ../dashboard");
            exit();
        }else{
            header("location: ./?page=login&error=invalidmailorpassword");
            exit();
        }
    }else{
        header("location: ./?page=login&error=invalidmailorpassword");
        exit();
    }
?>