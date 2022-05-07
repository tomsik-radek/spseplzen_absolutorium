<?php
    //print_r($_SESSION);
    echo("<br>");
    print_r($_POST);
    $subject = $_POST["subject"];
    $text = $_POST["text"];

    include("../includes/connect.inc.php");
    include("../tickets/includes/functions.inc.php");
    $randomAgentID = getRandomAgentID($conn);
    echo("random agent id " . $randomAgentID);
    $userid = $_SESSION["userinfo_userid"];
    echo("userid: $userid <br>");
    echo("subject: $subject <br>");
    $archived = "0";

    $timestamp = date('Y-m-d H:i:s');
    $sql = "INSERT INTO tickets(userid, subject, text, lastEdited, assignedAgent,archived)
        VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss",$userid,$subject,$text,$timestamp,$randomAgentID,$archived);
    if($stmt->execute()){
        $zero = "0"; //These two are necessary because $stmt->bind_param("sssss",$ticketid, "1", "0", "0", "0");
        $one = "1";  //throws  Uncaught Error: Cannot pass parameter 3 by reference error, it doesn't accept strings
        echo("ticket added <br>");

        $sql = "SELECT * FROM tickets ORDER BY id DESC LIMIT 1";
        echo "ticketid sql $sql <br>";
        $stmt = mysqli_query($connNP, $sql);
            while($result = mysqli_fetch_array($stmt)){
            $ticketid = $result["id"];
        }
    
        //echo "ticketid $ticketid <br>";
        
        $sql = "INSERT INTO flags(ticketid, open, closed, inprogress, urgent)
        VALUES(?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss",$ticketid, $one, $zero, $zero, $zero);
        if($stmt->execute()){
            echo("flags added <br>");
        }else{
            echo("flags not added <br>");
            echo($stmt->error);
        }
        header("location: ../?page=list");
        exit();
    }else{
        echo("ticket not added <br>");
    }
?>