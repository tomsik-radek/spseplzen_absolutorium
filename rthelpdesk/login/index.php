<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        //print_r($_SESSION);
    }
?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="css/default.css">
    <?php
    if(isset($_SESSION["theme"])){
        if($_SESSION["theme"] === "light"){
            ?>
            <link rel="stylesheet" href="css/light.css">
            <?php
        }elseif($_SESSION["theme"] === "dark"){
            ?>
            <link rel="stylesheet" href="css/dark.css">
            <?php
        }
    }
    if(!isset($_SESSION["theme"])){
        $_SESSION["theme"] = "light";
        ?>
        <link rel="stylesheet" href="css/light.css">
        <?php
    }

    ?>
    <?php
    include("../includes/title.php");
    if(!isset($_GET["page"])){
        ?>
            <title>Log In</title>
        <?php
    }
    ?>
</head>
<body>
<?php
    //print_r($_GET) . "<br>";
    if(isset($_SESSION["userinfo_userid"]) && (isset($_SESSION["userinfo_email"]) && (isset($_SESSION["userinfo_email"])
        && isset($_SESSION["userinfo_usergroup"]) && isset($_SESSION["userinfo_lang"]) && (isset($_SESSION["userinfo_theme"]))))){
            header("location: ../index.php?msg=loggedin");
            exit();
    }else{
        if (isset($_GET["page"])) {
            if ($_GET["page"] === "login") {
                include("./login.php");
            } elseif ($_GET["page"] === "register") {
                include("./register.php");
            } elseif ($_GET["page"] === "passwordreset") {
                include("./passwordrecovery/pswdrec_firstform.php");
            } elseif ($_GET["page"] === "pswdrecoveryform"){
                include("./passwordrecovery/pswdrec_newpswdform.php");
            } elseif ($_GET["page"] === "pswdrecovery"){
                include("./passwordrecovery/changepassword.inc.php");
            }
        }elseif(isset($_GET["action"])){
            if($_GET["action"] === "sendrecmail"){
                include("./passwordrecovery/sendmail.inc.php");
            }elseif($_GET["action"] === "login"){
                include("./includes/login.inc.php");
            }elseif($_GET["action"] === "register"){
                include("./includes/register.inc.php");
            }elseif($_GET["action"] === "changetheme"){
                include("./includes/changetheme.inc.php");
            }
        } else {
            include("./login.php");
            //echo "No parameter match1<br>";
            ?>
                <link rel="stylesheet" href="css/login-light.css">
            <?php
        }
        //include("./includes/gethandlers.inc.php");
    }
?>
</body>