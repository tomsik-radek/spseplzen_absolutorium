<?php
    include("../includes/functions.inc.php");   
?>
<div class="topNav">
    <div style="float: left" class="linkOutside">
        <a class="linkInside" href="../?page=list">Home</a>
    </div>
    <div class="linkOutside">
        <a class="linkInside rightLink" href="../dashboard/?action=logout">Logout</a>
    </div>
    <div class="linkOutside">
        <a class="linkInside" href="../settings">Settings</a>
    </div>
    <?php
        if (isAdmin($_SESSION["userinfo_usergroup"])) {
    ?>
<div class="navSeparator">
    &#8203;
</div>    
<div class="linkOutside">
    <a href="../dashboard/?page=users">Users</a>
</div>

    <?php
        }
    ?>
</div>
