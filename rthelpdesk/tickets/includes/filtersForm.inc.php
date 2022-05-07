<?php
    $sort;
    if(isset($_GET["sortbytime"])){
        $sort = ($_GET["sortbytime"]);
    }else{
        $sort = "DESC";
    }

    $sqlAddFlagClosed;
    $sqlAddFlagOpen;
    $sqlAddFlagInprogress;
    $sqlAddFlagUrgent;
    //Flags to SQL query
    if(isset($_GET["fcc"])){
        $sqlAddFlagClosed = " WHERE flags.closed = 1";
        $sqlAddFlagInprogress = "";
        $sqlAddFlagUrgent = "";
    }else{
        $sqlAddFlagClosed = " WHERE flags.open = 1";
        if(isset($_GET["fcp"])){
            $sqlAddFlagInprogress = " AND flags.inprogress = 1";
        }else{
            $sqlAddFlagInprogress = "";
        }
    
        if(isset($_GET["fcu"])){
            $sqlAddFlagUrgent = " AND flags.urgent = 1";
        }else{
            $sqlAddFlagUrgent = "";
        }
    }
?>

<div class="filters">
    <form method="GET" action="./" name="sortForm">
    <input hidden name="page" value="list"></input>
    <fieldset class="timeSort">
        <!-- I had to do this align="center" terribleness because firefox ignores text-align in css or even in inline style=""
            https://stackoverflow.com/questions/21134866/legend-not-centering-in-firefox#:~:text=It%27s%20easier%20than%20we%20thought.
        -->
        <legend>Sort</legend>
        <div>
            <select name="sortbytime">
                <option value = '' name="emptySortOption" selected disabled>Sort by ticket ID</option>
                <option value="ASC" name="ascSortOption"<?php if($sort == "ASC"){echo "selected";} ?>>ASCENDING</option>
                <option value="DESC" name="descSortOption" <?php if($sort == "DESC"){echo "selected";} ?>>DESCENDING</option>
            </select>
        </div>
    </fieldset>
    <fieldset class="flagFilter">
        <legend>Filter</legend>
        <div class="flags">
            <div class="flag2"> <!-- Flag CLOSED -->
                <input name="fcc" type="checkbox"
                <?php
                    if(isset($_GET["fcc"])){
                        echo "checked";
                    }
                ?>
                ></input>
                <label for="fcc">Closed</label>
                <br>
            </div>
            <div class="flag2">  <!-- Flag WORKING -->
                <input name="fcp" type="checkbox"
                <?php
                    if (!isset($_GET["fcc"])) {
                        if (isset($_GET["fcp"])) {
                            echo "checked";
                        }
                    }
                ?>
                ></input>
                <label for="fcp">Working</label>
                <br>
            </div>
            <div class="flag2">  <!-- Flag URGENT -->
                <input name="fcu" type="checkbox"
                <?php
                    if (!isset($_GET["fcc"])) {
                        if (isset($_GET["fcu"])) {
                            echo "checked";
                        }
                    }
                ?>
                ></input>
                <label for="fcu">Urgent</label>
                <br>
            </div>
        </div>
    </fieldset>
    <div class="submitButton">
        <button class="sortbutton" type="submit">Apply</button>
    </div>
    </form>
</div>

<?php 
    /*echo(" Closed:  $sqlAddFlagClosed . <br>");
    echo(" urgent:  $sqlAddFlagUrgent . <br>");
    echo(" working:  $sqlAddFlagInprogress . <br>");*/
?>