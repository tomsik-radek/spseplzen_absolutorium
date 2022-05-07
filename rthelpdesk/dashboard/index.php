<!--
    All this file does is loads correct CSS files and checks if user is logged in by checking $_SESSION variables
-->
<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    //include("../includes/functions.inc.php");
    //print_r($_SESSION);
?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <?php
    if ($_SESSION["userinfo_theme"] === "dark") {
        ?>
        <link rel="stylesheet" href="../css/default.css">
        <link rel="stylesheet" href="../css/dark.css">
        <?php
    }else{
        ?>
        <link rel="stylesheet" href="../css/default.css">
        <link rel="stylesheet" href="../css/light.css">
        <?php
    }
    include("../includes/title.php");
    if(!isset($_GET["page"])){
        ?>
            <title>Dashboard</title>
        <?php
    }
    ?>
</head>
<body>
    <?php
        if(isset($_SESSION["userinfo_userid"]) && (isset($_SESSION["userinfo_email"])
        && isset($_SESSION["userinfo_usergroup"]) && isset($_SESSION["userinfo_lang"]) && (isset($_SESSION["userinfo_theme"])))){
            /* GET handler for a logout link */
            if (isset($_GET["action"])) {
                if ($_GET["action"] === "logout") {
                    header("location: ../login/logout.php");
                    exit();
                }
            }
            include("./dashboard.php"); 
            ?>
    <?php
        } /* If not all variables are set, user is not logged in an will be redirected to the login page */
        else{
            header("location: ../login");
            exit();
        }
    ?>
</body>

