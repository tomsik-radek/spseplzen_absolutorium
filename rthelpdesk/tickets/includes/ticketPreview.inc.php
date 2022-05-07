<?php
    //print_r($_SESSION);
    //print_r($row);
    $ticketid = $row["ticketid"];
?>

<div>
    <div class="ticketCluster">
        <div class="ticketHead">
            <div class="ticketFlags">
                <?php include("../tickets/includes/printFlags.inc.php") ?>
            </div>
            <div class="ticketid">
                <?php echo("Ticket ID: " . $ticketid) ?>
            </div>
        </div>
        <table class="ticketText">
            <tr>
                <td class="title">Subject</td>
                <td class="notTitle">
                    <?php echo($row['subject']) ?>
                </td>   
            </tr>
            <tr>  
                <td class="title">Text</td>
                <td class="notTitle">
                    <?php echo($row['text']) ?>
                </td>    
            </tr> 
        
        <?php
        
            include("../includes/connect.inc.php");
            $sql = "SELECT * FROM users RIGHT JOIN tickets ON tickets.userid = users.id WHERE tickets.id = ?;";
            //echo("sql: " . $sql . "<br>");
            //echo("id: " . $ticketid . "<br>");
            $stmt2 = $conn->prepare($sql);
            $stmt2->bind_param("s",$ticketid);
            if($stmt2->execute()){
                //echo("tickets2 success <br>");
            }else{
                echo("tickets2 searchfail <br>");
            }
            $result2 = $stmt2->get_result();
            while($row2 = mysqli_fetch_assoc($result2)){
                $assignedAgentID = $row2["assignedAgent"];
                $assignedAgentName = $userArray[$assignedAgentID];
                $ticketOwnerName = $row2["nickname"];
            }
            
            ?>
                <tr>
                    <td class="title">Created by</td>
                    <td class="notTitle">
                        <?php echo $ticketOwnerName;?>
                    </td> 
                </tr>
                <tr>  
                    <td class="title">Assigned to</td>
                    <td class="notTitle">
                        <?php echo $assignedAgentName;?>
                    </td>    
                </tr>
                <tr>
                    <td class="title">Last Edited</td>
                    <td class="notTitle">
                        <?php echo $row['lastEdited'];?>
                    </td>
                </tr> 
            </table>
            <?php
            mysqli_close($conn);
        ?>
        <div class="editButton">
            <a href="./?page=edit&ticket=<?php echo($ticketid) ?>">View and Edit</a>
        </div>
    </div>
</div>