<?php
    $debug = false;
    echo "reg inc php <br>";
    if(isset($_POST["inputname"]) && (isset($_POST["inputemail"]) && (isset($_POST["inputpassword1"])&&(isset($_POST["inputpassword2"]))))){
        $name = $_POST["inputname"];
        $inputemail = $_POST["inputemail"];
        $inputpassword1 = $_POST["inputpassword1"];
        $inputpassword2 = $_POST["inputpassword2"];
        if(isset($_POST["dateofbirth"])){
            $birthdate = date('Y-m-d', strtotime($_POST['dateofbirth']));
        }else{
            $birthdate = "0000-00-00";
        }

        require("./includes/functions.inc.php");
        require("../includes/connect.inc.php");

        //Is this an email?
        if(isValidMail($inputemail) !== false){
            if($debug === true){
                echo "email is valid <br>";
            }
        }else{
            header("location:  ./?page=register&error=invalidmailformat");
            exit();
            echo("Name: $name <br>");
        }
    
        //Do both entered passwords match
        if(pswdMatch($inputpassword1,$inputpassword2) !== false){
            if($debug === true){
                echo "passwords $inputpassword1 and $inputpassword2 match <br>";
            }
        }else{
            header("location: ./?page=register&error=passwordsdontmatch");
            exit();
        }
    
        //Does password meet requirements (lenght etc). No need to bother checking for validity if it is too short etc
        if(pswdReqs($inputpassword1) !== false){   
            if($debug === true){
                echo "password meets requirements <br>";
            }
        }else{
            header("location:  ./?page=register&error=passwordrequirements");
            exit();
        }
    
        //Is there a user with $email already registered
        if(userExists($conn, $inputemail) !== false){
            header("location:  ./?page=register&error=useralreadyregistered");
            exit();
        }
    
        //Trying to create a user with provided information
        if(createUser($conn,$name, $inputemail, $inputpassword1, $birthdate) !== false){
            header("location:  ./?page=register&error=regsuccess");
            exit();
        }else{
            header("location:  ./?page=register&error=catastrophic");
            exit();
        }
    }else{
        echo("oops");
    }
?>