
<?php
    $ticketidArray = [];
    $i = 0;

    include("../includes/connect.inc.php");
    $userArray = [];
    $userArray = loadUsersIntoArray($connNP);
    //include("../includes/functions.inc.php");
    $userid = $_SESSION["userinfo_userid"];
    //print_r($_SESSION);
    ?>
    <div class="newTicket">
        <div class="linkButton">
        <?php
        if (isUser($_SESSION["userinfo_usergroup"])) {
        ?>
            <a href="./?page=new">New Ticket</a>
        <?php
        }
        ?>
        </div>
    </div class="newTicket">
    <?php

    if (isUser($_SESSION["userinfo_usergroup"])) {
        $sql = "SELECT * FROM flags RIGHT JOIN tickets ON tickets.id = flags.ticketid $sqlAddFlagClosed $sqlAddFlagInprogress $sqlAddFlagUrgent AND tickets.userid = $userid ORDER BY created $sort;";
        //echo "usertickets sql $sql <br>";
    }elseif(isAgent($_SESSION["userinfo_usergroup"])){
        $sql = "SELECT * FROM flags RIGHT JOIN tickets ON tickets.id = flags.ticketid $sqlAddFlagClosed $sqlAddFlagInprogress $sqlAddFlagUrgent /*AND tickets.assignedAgent = $userid */ ORDER BY created $sort";
        //echo "agentticket sql $sql <br>";
    }elseif(isAdmin($_SESSION["userinfo_usergroup"])){
        if(isset($_SESSION["data_adminQuery"])){
            //echo($_SESSION["data_adminQuery"] . "<br>");
            $userid = $_SESSION["data_adminQuery"];
            $sql = "SELECT * FROM flags RIGHT JOIN tickets ON tickets.id = flags.ticketid WHERE tickets.userid = $userid ORDER BY created $sort";
            ?>
            <div style="font-size: 1.2em; margin-bottom: 4px;">
                Showing tickets of #<?php echo $userid ?><br>
            </div>
        <?php
        }else{
            //echo("admin query empty <br>");
            $sql = "SELECT * FROM flags RIGHT JOIN tickets ON tickets.id = flags.ticketid $sqlAddFlagClosed $sqlAddFlagInprogress $sqlAddFlagUrgent ORDER BY created $sort";
        }
        //echo("admin sql $sql <br>");
    }else{
        echo "We have a very big problem. No valid permission = no valid query. Sorry!<br>";
    }
    //echo("sql 10: $sql <br>");
    $stmt = mysqli_query($conn, $sql) or die ("database error: " . mysqli_error($conn));
    if(mysqli_num_rows($stmt) != 0) {
        while($row = mysqli_fetch_assoc($stmt)){
            //include("../tickets/includes/ticketPreview.inc.php");
            include("../tickets/includes/ticketPreview2.inc.php");
        }
    }
?>