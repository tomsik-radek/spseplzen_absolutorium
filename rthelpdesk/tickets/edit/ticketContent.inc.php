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
                <input type="text" hidden name="ticket_creator" value="<?php echo $ticketCreator ?>"></input>
                <input type="text" hidden name="ticket_assignedAgentName"
                    value="<?php echo $ticketAssignedAgent ?>"></input>
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
<!--
<div>
    <div>
        <div class="<?php if(isUser($ticketRes["usergroup"])){echo('userHeader'); }else{echo('notUserHeader'); }?>">
            <?php echo("On " . trim($ticketRes["created"]) . " by " .trim($userArray[$ticketRes["userid"]])); ?>
        </div>
        <div class="<?php if(isUser($ticketRes["usergroup"])){echo('userMessage'); }else{echo('notUserMessage'); }?>">
            <?php echo(trim($resAdditional["text"]));?>
        </div>
    </div>
    <div>
        <div class="userHeader">
            <?php echo("On " . trim($ticketRes["created"]) . " by " .trim($userArray[$ticketRes["userid"]])); ?>
        </div>
        <div class="userMessage">
            <?php echo($ticketRes["text"]);?>
        </div>
    </div>
</div>
-->
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
<!--<div class="msgOuter">
    <div class="msgHeader">
        <table>
            <tr>
                <td class="tdName"><?php echo(trim($userArray[$resAdditional["responseuserid"]])); ?>
                </td>
                <td class="tdTime"><?php echo(trim($resAdditional["msgTime"])); ?></td>
            </tr>
        </table>
    </div>
    <div class="msgInner additionalMessages"><?php echo(trim($resAdditional["text"]));?></div>
</div>
<div class="msgOuter">
    <div class="msgHeader">
        <table>
            <tr>
                <td class="tdname"><?php echo(trim($userArray[$ticketRes["userid"]])); ?></td>
                <td class="tdtime"><?php echo(trim($ticketRes["created"])); ?></td>
            </tr>
        </table>
    </div>
    <div class="firstMessage msgInner"><?php echo($ticketRes["text"]);?>
    </div>
</div>
    -->


<?php
    }                       
?>