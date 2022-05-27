<?php
    echo("Appending ticket <br>");
    echo("GET: ");
    print_r($_GET);
    echo("<br>");
    echo("POST: ");
    print_r($_POST);
    echo("<br>");
    print_r($_SESSION);
    echo("<br>");
    include("../includes/connect.inc.php");

    if(isset($_POST)){
        if(!empty($_POST["inputText"])){
            echo ("text not empty <br>");
            $timestamp = date('Y-m-d H:i:s');
            $sql = "INSERT into tickets_additional(ticketid, responseuserid, text, msgTime) VALUES (?,?,?,?);";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiss",$_SESSION["editticketid"],$_SESSION["userinfo_userid"],$_POST["inputText"],$timestamp);
            if($stmt->execute()){
                echo("response added <br>");
            }else{
                echo("response adding failed <br>");
            }
        }else{
            echo("text empty <br>");
            if(isset($_POST["fcc"])){
                if($_POST["fcc"] === "on"){
                    echo("closing ticket");
                    $sql = ("UPDATE flags SET open=0, closed=1 WHERE ticketid = ?");
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s",$_SESSION["editticketid"]);
                    if($stmt->execute()){
                        echo("flag update success <br>");
                    }else{
                        echo("flag update failed <br>");
                    }
                }
            }if(!isset($_POST["fcc"])){
                echo("opening ticket");
                $sql = ("UPDATE flags SET open=1, closed=0 WHERE ticketid = ?");
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s",$_SESSION["editticketid"]);
                    if($stmt->execute()){
                        echo("flag update success <br>");
                    }else{
                        echo("flag update failed <br>");
                    }
            }
        }
    }
    $stmt->close();
    //print_r($_SESSION);
    $editticket = $_SESSION["editticketid"];
    header("location: ./?page=edit&ticket=$editticket");
    exit();
?>