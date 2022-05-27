<form method="POST" action="./?action=changepassword">
    <div class="settings_passwordChangeForm">
        <div class="settings_input">
            <label for="currentPassword">Current Password</label>
            <input type="password" name="currentPassword"></input>
        </div>
        <div class="settings_input">
            <label for="newPassword1">New Password</label>
            <input type="password" name="newPassword1" maxlength="32"></input>
        </div>
        <div class="settings_input">
            <label for="newPassword2">Repeat New Password</label>
            <input type="password" name="newPassword2" maxlength="32"></input>
        </div>
        <div class="settings_passwordChangeFormSubmit">
            <input type="submit" value="Change Password"></input>
        </div>
        <div class="settings_pswdchange_msgBox">
            <?php
                if(isset($_GET["msg"])){
                    if($_GET["msg"] === "success"){
                        echo("Password changed");
                    }elseif($_GET["msg"] === "reqs"){
                        echo("New password doesn't meet security requirements. Please try again.");
                    }
                    elseif($_GET["msg"] === "currwrong"){
                        echo("Your entered current password is incorrect. Please try again.");
                    }
                    elseif($_GET["msg"] === "oldpassnewpass"){
                        echo("Old password cannot be the same as a new password. Please try again.");
                    }
                    elseif($_GET["msg"] === "newpassnotmatch"){
                        echo("New passwords do not match. Please try again.");
                    }
                }
            ?>
        </div>
    </div>
</form>