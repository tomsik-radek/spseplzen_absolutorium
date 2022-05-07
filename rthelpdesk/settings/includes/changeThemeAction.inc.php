<?php
    print_r($_POST);
    $newTheme = $_POST["themeSelect"];
    
    if($newTheme === "light"){
        $_SESSION["userinfo_theme"] = "light";
        $sql = "UPDATE users SET theme = 'light' WHERE id = ?;";
    }elseif($newTheme === "dark"){
        $_SESSION["userinfo_theme"] = "dark";
        $sql = "UPDATE users SET theme = 'dark' WHERE id = ?;";
    }
    include("../includes/connect.inc.php");
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$_SESSION["userinfo_userid"]);
    if($stmt->execute()){
        echo("theme changed");
    }else{
        echo("theme not changed");
    }
    header("location: ./?page=changetheme");
    exit();
?>