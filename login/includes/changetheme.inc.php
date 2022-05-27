<?php

if(isset($_SESSION["theme"])){
    if($_SESSION["theme"] === "dark"){
        $_SESSION["theme"] = "light";
        //echo("changing theme to light");
    }
    elseif($_SESSION["theme"] === "light"){
        $_SESSION["theme"] = "dark";
        //echo("changing theme to dark");
    }
}
if(!isset($_SESSION["theme"])){
    $_SESSION["theme"] = "light";
    //echo("theme var not set");
}
print_r($_SESSION);
header("location: ./");
exit();
