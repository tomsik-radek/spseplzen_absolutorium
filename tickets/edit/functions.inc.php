<?php
    function getUsersOnMyLevel(){
        include("../includes/connect.inc.php");
        $myperm = $_SESSION["userinfo_usergroup"];
        $sql = "SELECT * FROM users WHERE usergroup = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$myperm);
        if($stmt->execute()){
            //echo("querymylvl success <br>");
        }else{
            //echo("querymylvl failed <br>");
        }
        $stmt = $stmt->get_result();
        return $stmt;
    }

    function getAgents(){
        include("../includes/connect.inc.php");
        $myperm = $_SESSION["userinfo_usergroup"];
        $sql = "SELECT * FROM `users` WHERE `usergroup` < 5 AND `usergroup` > 1";
        $stmt = mysqli_query($connNP, $sql);
        return $stmt;
    }

    function reassignSelect($array){
        //echo "array lenght " . mysqli_num_rows($array);
        if (mysqli_num_rows($array) > 1) {
            ?> 
        <form action="./?action=reassignticket" method="POST">
            <select name="reassignTo">
                <?php
                    if(mysqli_num_rows($array) !== 0){
                        while ($row = mysqli_fetch_assoc($array)) {
                            if ($row["id"] !== $_SESSION["userinfo_userid"]) {
                                echo "<option value=" . $row["id"] .   ">" . $row["nickname"] . "</option>";
                            }
                        } 
                    }else{

                    }
                    ?>
            </select>
            <button style="all: revert" type="submit">Reassign</button>
        </form>
        <?php
        }else{
            echo "There is noone this ticket can be reassigned to. Sorry! <br>";
        }
    }

    function getUsersGroup($userid){
        include("../includes/connect.inc.php");
        $sql = "SELECT usergroup FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$userid);
        if($stmt->execute()){
            //echo("usergroup find success <br>");
            $stmt = $stmt->get_result();
            while($row = mysqli_fetch_assoc($stmt)){
                $usergroup = $row["usergroup"];
                return $usergroup;
            }
        }else{
            echo("usegroup find fail <br>");
            return "usergroup search failed <br>";
        }
    }
?>