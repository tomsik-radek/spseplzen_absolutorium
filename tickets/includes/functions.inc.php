<?php
    function loadUsersIntoArray($conn){
        $sql = "SELECT id, nickname FROM users";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $userArray[$row["id"]] = $row["nickname"];
        }
        return $userArray;
    }

    function printArray($userArray){
        $userArrayMaxIndex = max(array_keys($userArray));
        for($i = 0; $i <= $userArrayMaxIndex; $i++){
            if(array_key_exists($i,$userArray)){
                echo($i . ": " . $userArray[$i] . "<br>");
            }
        }
    }

    function userOwnsTicket($conn,$ticketid,$userid,$userpermission){
        $hit = 0;
        //echo("isuser: " . $isUser . "<br>");
        if (isUser($userpermission) == 1) {
            //echo("is user <br>");
            $sql = "SELECT id, userid FROM tickets WHERE userid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s",$userid);
        }elseif (isAgent($userpermission)){
            //echo("is agent <br>");
            $sql = "SELECT id, assignedAgent FROM tickets WHERE assignedAgent = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s",$userid);
        }elseif(isAdmin($userpermission)){
            $sql = "SELECT id, assignedAgent FROM tickets";
            $stmt = $conn->prepare($sql);
        }else{
            echo("null");
            return;
        }
        if($stmt->execute()){
            //echo "query success <br>";
            $stmt = $stmt->get_result();
            if(mysqli_num_rows($stmt) === 0){
                //echo "return is 0 <br>";
            }else{
                //echo "return is not 0 <br>";
                while ($row = mysqli_fetch_assoc($stmt)) {
                    if($row["id"] == $ticketid){
                        $hit++;
                        //echo("hit<br>");
                    }
                }
                if($hit === 0){
                    return false;
                }elseif($hit === 1){
                    return true;
                }else{
                    return false;
                }
            }
        }else{  
            echo "query failed <br>";
            return false;
        }
        return true;
    }

    function getRandomAgentID($conn){
        //return 19;
        $agentArray = [];
        $i = 0;
        $two = "2";
        $sql = "SELECT * FROM users WHERE usergroup = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$two);
        if($stmt->execute()){
            echo("random agent success <br>");
            $stmt = $stmt->get_result();
            while ($row = mysqli_fetch_assoc($stmt)) {
                echo("agent ids: " . $row["id"] . "<br>");
                $agentArray[$i] = $row["id"];
                $i++;
            }
            $randomIndex = array_rand($agentArray, 1);
            //echo("random index:  $randomIndex <br>");
            return($agentArray[$randomIndex]);
        }else{
            echo("random agent failed");
        }
        return 19;
    }

    function openFlag(){
        ?>
        <div class="flag flagOpen">
            Open
        </div>
        <?php
    }
    function closedFlag(){
        ?>
        <div class="flag flagClosed">
            Closed
        </div>
        <?php
    }
    function workingFlag(){
        ?>
        <div class="flag flagWorking">
            Working
        </div>
        <?php
    }
    function urgentFlag(){
        ?>
        <div class="flag flagUrgent">
            Urgent
        </div>
        <?php
    }
?>  