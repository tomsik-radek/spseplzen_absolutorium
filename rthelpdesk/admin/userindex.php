<?php
    $sql = "SELECT id, nickname, email, usergroup FROM users;";
    include("../includes/connect.inc.php");
    $stmt = $conn->prepare($sql);
    if($stmt->execute()){
        /*echo("user sql success");*/
    }else{
        /*echo("user sql fail");*/
    }
    $res = $stmt->get_result();
?>
<div class="adminUserTable">
    <div class="scroll1">
        <div class="scroll2">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Group</th>
                    <th>Edit</th>
                    <th>User Tickets</th>
                </tr>
                <?php
                while($row = mysqli_fetch_assoc($res)){
                    $rowid = $row["id"];
                ?>
                <tr>
                    <td id="id"><?php echo $rowid?></td>
                    <td id="name"><?php echo $row["nickname"]?></td>
                    <td id="email"><?php echo $row["email"]?></td>
                    <td id="group"><?php echo $row["usergroup"]?></td>
                    <td id="edit">
                        <a href="./?action=editUser&id=<?php echo($rowid) ?>">Edit #<?php echo($rowid)?></a> 
                    </td>
                    <td id="viewtickets">
                        <a href="./?action=viewTickets&id=<?php echo($rowid) ?>">View #<?php echo($rowid)?></a>
                    </td>  
                </tr>
                <?php
                }
                $stmt->close();
                ?>
            </table>
        </div class="scroll2">
    </div class="scroll1"> 
</div>