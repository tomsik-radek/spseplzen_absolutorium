<?php
    include("./includes/functions.inc.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        //print_r($_SESSION) . "<br>";
    }

    if(isset($_SESSION["userinfo_userid"]) && (isset($_SESSION["userinfo_email"]) && (isset($_SESSION["userinfo_email"])
        && isset($_SESSION["userinfo_usergroup"]) && isset($_SESSION["userinfo_lang"]) && (isset($_SESSION["userinfo_theme"]))))){
        header("location: ./dashboard");
        exit();
    }else{
        header("location: ./login/?msg=notloggedin");
        exit();
    }
?>