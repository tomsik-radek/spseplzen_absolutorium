<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    ?>
    <title>Settings</title>
</head>
<body>
<div class="center-screen">
    <div class="outercontainer">
        <div class="topNav">
        <?php
            include("../includes/topnav.inc.php");
        ?>
        </div class="topNav">
        <div class="innercontainer">    
            <div class="settings_sidebar">
            <?php
                include("./includes/sidebar.inc.php");
            ?>
            </div>
            <div class="settings_content">
            <?php
            if(isset($_GET)){
                if (isset($_GET["page"])) {
                    if ($_GET["page"] === "changepassword") {
                        include("./passwordChangeForm.php");
                    }
                    if ($_GET["page"] === "changetheme") {
                        include("./changeThemeForm.php");
                    }
                }
                if (isset($_GET["action"])) {
                    if ($_GET["action"] === "changepassword") {
                        include("./includes/passwordChangeAction.inc.php");
                    }
                    if ($_GET["action"] === "changetheme") {
                        include("./includes/changeThemeAction.inc.php");
                    }
                }
            }
            ?>
            </div>
        </div class="innercontainer">
    </div class="outercontainer">
</div class="center-screen">
</body>
</html>

<style>
    @media (min-width: 1281px) {
        .innercontainer{
            overflow: auto;
        }
    }
</style>
