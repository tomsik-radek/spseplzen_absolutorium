<?php
    function getUsersCurrentLevel($conn,$userid){
        $sql = "SELECT usergroup FROM users WHERE id = $userid;";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $group = $row["usergroup"];
        }
        return $group;
    }
?>