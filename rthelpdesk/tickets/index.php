<div>
    <?php //print_r($_SESSION);
    include("../tickets/includes/functions.inc.php");
    ?>
</div>
<div class="parent">
    <div class="sidebar">
        <?php
        include("../tickets/includes/filtersForm.inc.php");
        ?>
    </div>
    <div class="tickets">
        <?php
            include("../tickets/printTickets.php");
        ?>
    </div>
    
</div>