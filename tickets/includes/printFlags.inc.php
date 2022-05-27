<div>
    <?php
        $ticket_open = $row["open"];
        $ticket_closed = $row["closed"];
        $ticket_inprogress = $row["inprogress"];
        $ticket_urgent = $row["urgent"];
    ?>
    <div>  
        <?php if($ticket_open == true){
        openFlag(); 
        } ?>
    </div>
    <div>
        <?php if($ticket_closed == true){
        closedFlag();
        } ?>
    </div>
    <div>
        <?php if($ticket_inprogress == true){
        workingFlag();
        } ?>
    </div>
    <div>
        <?php if($ticket_urgent == true){
        urgentFlag();
        } ?>
    </div>
</div>