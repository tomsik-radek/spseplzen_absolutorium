<div style="overflow: hidden">
    <div class="msgHeader">
        Add your response
    </div>
    <div>
        <!-- Append form bleeds to the next div!!-->
        <form method="POST" action="./?action=appendticket" name="apendTicketForm">
            <div class="editTicket">
                <textarea name="inputText" maxlength="1024"></textarea>
            </div>
    </div>
    <div class="nav3">
        <div style="float: right; margin-left: 16px;">
            <input type="submit" class="edit_submitButton" value="Post Comment"></input>
            </form> <!-- end of append form -->
        </div>
        <div style="float: right;">
            <form method="POST" action="./?action=appendticket" name="closeBtnForm">
    <?php
    if ($ticket_open == 1 && $ticket_closed == 0) {?>
                <input type="checkbox" hidden name="fcc" checked>
                <input type="submit" class="submitButton" value="Close Ticket">
                <?php
    }elseif ($ticket_open == 0 && $ticket_closed == 1){ ?>
                <input type="checkbox" hidden name="fcc">
                <input type="submit" class="submitButton" value="Open Ticket">
                <?php } ?>
            </form>
        </div>
        <?php
        if (!isUser($_SESSION["userinfo_usergroup"])) {
            include("../tickets/edit/agentNav.inc.php");
        }
        ?>
    </div>
</div>
<?php
    $sql3 = "SELECT * FROM tickets_additional WHERE ticketid = $editTicketID ORDER BY id DESC;";
    //echo("sql3: $sql3 <br>");
    $res3 = mysqli_query($connNP,$sql3);
    while ($resAdditional = mysqli_fetch_assoc($res3)) {
?>
<div>
    <?php
        //echo("response user id " . $resAdditional["responseuserid"]);
        $userGroup = getUsersGroup($resAdditional["responseuserid"]);
        //echo("users usergroup is: " . $userGroup);
    ?>
    <div class="<?php
        if(isUser($userGroup)){
            echo('header userHeader');
        }else{
            echo("header notUserHeader");
        }
    ?>">
        <?php echo("On " . trim($resAdditional["msgTime"]) . " by " . trim($userArray[$resAdditional["responseuserid"]])); ?>
    </div>
    <div class="<?php
        if(isUser($userGroup)){
            echo('message userMessage');
        }else{
            echo("message notUserMessage");
        }
    ?>">
        <?php echo(trim($resAdditional["text"]));?>
    </div>
</div>

<?php
    }                       
?>
<div>
    <div>
        <div class="<?php if(isUser($ticketRes["usergroup"])){echo('userHeader'); }else{echo('notUserHeader'); }?>">
            <?php echo("On " . trim($ticketRes["created"]) . " by " .trim($userArray[$ticketRes["userid"]])); ?>
        </div>
    </div>
    <div>
        <div class="userMessage">
            <?php echo($ticketRes["text"]);?>
        </div>
    </div>
</div>