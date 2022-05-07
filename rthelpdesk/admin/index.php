<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//print_r($_SESSION);
?>
<head>
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
</head>
<body>
    <div class="outercontainer">
        <div class="topnav">
            <?php
                include("../includes/topnav.inc.php");
            ?>
        </div class="topNav">
        <div class="innercontainer">    
            <?php
                    
            ?>
        </div class="innercontainer">
    </div class="outercontainer">
</body>