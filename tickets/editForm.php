<?php
    if(isset($_GET["ticket"])){
        //echo($_GET["ticket"] . "<br>");
        include("../includes/connect.inc.php");
        include("../tickets/includes/functions.inc.php");
        include("../tickets/edit/functions.inc.php");

        //print_r($_SESSION);
        //include("../includes/functions.inc.php");
        $editTicketID = $_GET["ticket"];
        //echo("posting ticketid");
        $sql = "SELECT userid, assignedAgent FROM tickets WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$editTicketID);
        if($stmt->execute()){
            $stmt = $stmt->get_result();
            while($row = mysqli_fetch_assoc($stmt)){
                $ticketCreator = userIdIntoName($row["userid"]);
                $ticketAssignedAgent = userIdIntoName($row["assignedAgent"]);
            }
        }else{
            echo("ticketowner lookup failed <br>");
        }
        
        if (userOwnsTicket($conn, $editTicketID, $_SESSION["userinfo_userid"],$_SESSION["userinfo_usergroup"])) {
            //echo("user owns this ticket <br>");
            $_SESSION["editticketid"] = $editTicketID;
            /*echo("SESSION<br>");
            print_r($_SESSION) . PHP_EOL;
            echo("POST<br>");
            print_r($_POST);
            echo "<br>";*/
            $userArray = [];
            $userArray = loadUsersIntoArray($connNP);

            $sql = "SELECT * FROM users RIGHT JOIN tickets ON tickets.userid = users.id WHERE tickets.id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $editTicketID);
            if ($stmt->execute()) {
                $res1 = $stmt->get_result();
                while ($ticketRes = mysqli_fetch_assoc($res1)) {
                    //print_r($ticketRes);
            ?>
            <div class="edit_body">
                <div class="edit_header">
                    <div class="edit_row">
                        <div class="edit_left">
                            <?php
                            echo("Subject: ". $ticketRes["subject"]); ?>
                        </div>
                        <div class="edit_right">
                            <?php
                            echo("Ticket ID: #" . $ticketRes["id"]); ?>
                        </div>
                    </div>
                    <div class="edit_row">
                        <div class="edit_right">
                            
                        </div>
                        <div class="edit_left">
                            <?php
                            if($_SESSION["userinfo_nickname"] === $ticketCreator){
                                echo("Created by: &nbsp;" . "Me");
                            }else{
                                echo("Created by: &nbsp;" . $ticketCreator);
                            }
                            ?>
                        </div>
                    </div>
                    <div class="edit_row">
                        <div class="edit_right">
                            <?php
                                include("../includes/connect.inc.php");
                                $sql = "SELECT * FROM flags WHERE ticketid = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s",$editTicketID);
                                if($stmt->execute()){
                                    //echo("loading edit flags success");
                                    $stmt = $stmt->get_result();
                                    while($row = mysqli_fetch_assoc($stmt)){
                                        include("../tickets/includes/printFlags.inc.php");
                                    }
                                }else{
                                    //echo("loading edit flags fail");
                                }
                            ?>
                        </div>
                        <div class="edit_left">
                            <?php
                            if($_SESSION["userinfo_nickname"] === $ticketAssignedAgent){
                                echo("Assigned to: " . "Me");
                            }else{
                                echo("Assigned to: " . $ticketAssignedAgent);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="edit_content">
                    <div class="edit_ticketcontent">
                        <?php
                            include("../tickets/edit/ticketContent.inc.php"); ?>
                    </div class="edit_ticketcontent">
                </div class="edit_content">
            </div class="editBody">
        <?php
                }//end of ticketHeader while!!
            } else {
                echo "edtck fail <br>"; ?>
            <a href="./">Home</a>
            <?php
            }
        }else{
            //echo("user does not own this ticket <br>");
            header("location: ./");
            exit();
        }
    }
?>