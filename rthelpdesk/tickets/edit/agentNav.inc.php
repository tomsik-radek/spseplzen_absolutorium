
<div style="float: left">   
    <?php
        if(isAgent($_SESSION["userinfo_usergroup"])){
            $arrayUsersAsMe = getUsersOnMyLevel();
            reassignSelect($arrayUsersAsMe);
        }elseif(isAdmin($_SESSION["userinfo_usergroup"])){
            $arrayAgents = getAgents();
            reassignSelect($arrayAgents);
        }
    ?>
</div>
