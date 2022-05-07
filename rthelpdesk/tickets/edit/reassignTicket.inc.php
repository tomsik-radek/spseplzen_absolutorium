reassigning ticket
<?php
    print_r($_POST);
    $ticketid = $_SESSION["editticketid"];
    echo("Editing ticket  " . $ticketid . "<br>");
    $reassignto = $_POST["reassignTo"];

    include("../includes/connect.inc.php");
    $sql = "UPDATE tickets SET assignedAgent=? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii",$reassignto,$ticketid);
    if($stmt->execute()){
        echo("ticket reassigned <br>");
    }else{
        echo("ticket not reassigned <br>");
    }
    header("location: ./?page=list&msg=reassigned");
    exit();
?> 