viewing ticket of user <?php $_GET["id"] ?>
<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["data_adminQuery"] = $_GET["id"];
header("location: ./?page=list");
exit();