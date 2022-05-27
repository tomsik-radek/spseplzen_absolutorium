<?php
    if(isset($_POST)){
        if(isset($_POST["currentPassword"]) && isset($_POST["newPassword1"]) && isset($_POST["newPassword2"])){
            echo("changing password <br>");
            //print_r($_POST);
            echo("<br>");
            //print_r($_SESSION);
            echo("<br>");
            /*include("./includes/functions.inc.php");*/
            include("../login/includes/functions.inc.php");
            include("../includes/connect.inc.php");
            $curPassword = $_POST["currentPassword"];
            $newPassword1 = $_POST["newPassword1"];
            $newPassword2 = $_POST["newPassword2"];
            $currentUserID = $_SESSION["userinfo_userid"];
            if(pswdMatch($newPassword1,$newPassword2)){ // Checks if both new passwords are identical
                if (!pswdMatch($curPassword, $newPassword1)) { // Checks if the current entered password is NOT same as a new entered password
                    $sql = "SELECT encPass FROM users WHERE id = ?;";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $currentUserID);
                    if ($stmt->execute()) {
                        echo("pswdchange1 query success <br>");
                        $stmt = $stmt->get_result();
                        while ($row = mysqli_fetch_assoc($stmt)) {
                            $oldPassword= $row["encPass"]; // Gets current password from the database
                            $curPassword= encryptPassword($curPassword); // Encrypts the current entered password for comparison
                            if (pswdMatch($oldPassword, $curPassword)) { // If current entered and from database passwords match, proceed with the actual change
                                echo("continuing <br>");
                                if (pswdReqs($newPassword1)) {
                                    $newPasswordEnc = encryptPassword($newPassword1); //Encrypts new password
                                    if (changePassword($conn, $currentUserID, $newPasswordEnc)) { //Changes the password
                                        echo("pswdchange successful <br>");
                                        header("location: ./?page=changepassword&msg=success");
                                        exit();
                                    } else {
                                        echo("pswdchange failed <br>");
                                        header("location: ./?page=changepassword&msg=fail");
                                        exit();
                                    }
                                }else{
                                    echo("new pass doesn't meet requirements <br>");
                                    header("location: ./?page=changepassword&msg=reqs");
                                    exit();
                                }
                            } else {
                                echo("entered current password is incorrect <br>");
                                header("location: ./?page=changepassword&msg=currwrong");
                                exit();
                            }
                        }
                    } else {
                        echo("pswdchange1 fail <br>");
                        header("location: ./?page=changepassword&msg=fail2");
                        exit();
                    }
                }else{
                    echo("new pass cannot be same as old pass <br>");
                    header("location: ./?page=changepassword&msg=oldpassnewpass");
                    exit();
                }
            }else{
                echo("new pass not match");
                header("location: ./?page=changepassword&msg=newpassnotmatch");
                exit();
            }
        }
    }
?>