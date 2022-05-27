<?php
    function isUser($permission){
        if($permission == 1){
            return true;
        }else{
            return false;
        }
    }
    function isAdmin($permission){
        if($permission == 5){
            return true;
        }
        else{
            return false;
        }
    }
    function isAgent($permission){
        if(($permission > 1) && ($permission < 5)){
            return true;
        }else{
            return false;
        }
    }

    function userIdIntoName($userid){
        include("../includes/connect.inc.php");
        $sql = "SELECT nickname FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$userid);
        if($stmt->execute()){
            $stmt = $stmt->get_result();
            while($row = mysqli_fetch_assoc($stmt)){
                $name = $row["nickname"];
                return $name;
            }
        }else{
            return "user into id failed <br>";
        }
    }
?>