deleting user
<?php
    if (isAdmin($_SESSION["userinfo_usergroup"])) {
        $usertodelete = $_POST["usertodelete"];
        $sql = ("DELETE FROM `users` WHERE `users`.`id` = $usertodelete");
        include("../includes/connect.inc.php");
        $stmt = mysqli_query($connNP,$sql);
        $connNP->close();
        echo($sql);
        header("location: ./?page=users");
        exit();
    }else{
        header("location: ../?page=list");
        exit();
    }
?>