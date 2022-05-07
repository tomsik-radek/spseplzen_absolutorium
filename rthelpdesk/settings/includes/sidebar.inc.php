<?php
    //include("../includes/functions.inc.php");
?>
<div class="settings_sidebarMenu">
    <a href="./?page=changepassword">&bull;&nbsp;Change Password</a>
    <br>
    <a href="./?page=changetheme">&bull;&nbsp;Change Theme</a>
    <?php
        if (isAdmin($_SESSION["userinfo_usergroup"])) {
    ?>
    <br>
    <a href="./?page=changestatus">&bull;&nbsp;Change Status</a>
    <?php
    }?>
</div>
