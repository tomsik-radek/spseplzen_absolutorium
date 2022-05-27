<?php
    if (isset($_GET["id"])) {
        $userid = $_GET["id"];
        $sql = "SELECT id, nickname, email, usergroup FROM users WHERE id = $userid;";
        include("../includes/connect.inc.php");
        include("../admin/includes/functions.inc.php");
        $stmt = $conn->prepare($sql);
        if($stmt->execute()){
            /*echo("user sql success");*/
        
        $res = $stmt->get_result();
?>
<div class="adminUI">
    <div class="editUserTable">
        <div class="scroll1">
            <div class="scroll2">
                <form method="POST" action="./?action=saveUserChanges">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Usergroup</th>
                        </tr>
                    <?php
                    while($row = mysqli_fetch_assoc($res)){
                        $userid = $row["id"];
                        $usersLevel = getUsersCurrentLevel($conn,$userid);
                        $email = $row["email"];
                        //echo("users level : " . $usersLevel . "<br>");
                    ?>
                        <tr>
                            <td class="editUser_id"><input name="userid" title="User ID can't be changed" readonly type="text" value="<?php echo $userid?>"></td>
                            <td><input name="nickname" type="text" value="<?php echo $row["nickname"]?>"></td>
                            <td><input name="email" type="text" value="<?php echo $row["email"]?>"></td>
                            <td><select name="usergroup">
                            <?php
                                $sql2 = "SELECT * FROM roles;";
                                $stmt2 = mysqli_query($conn,$sql2);
                                while($row2 = mysqli_fetch_assoc($stmt2)){     
                                    /*Sets value of the select to a usergroup ID         Preselects users current usegroup                   Prints usegroup name instead of just ID 
                                        Just a PHP way of saying
                                        <option value="1" selected>User</option>
                                    */                  
                                ?>
                                    <option value="<?php echo($row2["roleid"])?>" <?php if($row2["roleid"] === $usersLevel){echo("selected");} ?>><?php echo($row2["rolenick"]) ?></option>
                                <?php
                                }
                            ?>
                            </select></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </table>
                    <div>
                        <button type="submit">Save Changes</button>
                    </div>
                </form>
            </div class="scroll2">
        </div class="scroll1"> 
    </div>
    <div>
        <form method="POST" action="./?action=sendrecmail&return=admin">
            <div class="settings_passwordChangeForm adminPswdChange">
                <div class="settings_input">
                    <label class="custLabel" for="email" >Send user a password reset</label>
                    <input name="inputemail" type="text" readonly required value="<?php echo($email);?>"></input>
                </div>
                <div>                 
                    <button class="pswdreset-button" type="submit">Send reset link</button>
                </div>
            </div>
        </form>
    </div>
    <div>
        <form method="POST" action="./?action=deluser&return=admin" >
            <input type="text" name="usertodelete" hidden readonly value="<?php echo $userid?>">
            <div>
                <input type="submit" value="Delete user" onclick="return confirm('Are you sure?')">
            </div>
        </form>
    </div>
</div>
<?php
    /* Everything from line 8 to here happens in the if(), only if the SQL query succeeds */
        }else{
            echo("user sql fail");
        }
    $stmt->close();
    }
?>