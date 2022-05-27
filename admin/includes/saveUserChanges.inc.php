<?php
    if(isset($_POST)){
        if(isset($_POST["nickname"])){
            $nickname = $_POST["nickname"];
            echo("got here 1");
            if(isset($_POST["email"])){
                $email = $_POST["email"];
                echo("got here 2");
                if(isset($_POST["usergroup"])){
                    echo("got here 3");
                    if(isset($_POST["userid"])){
                        $id = $_POST["userid"];
                        $usergroup = $_POST["usergroup"];
                        echo("userid: " . $id . "<br>");
                        echo("nickname: ". $nickname . "<br>");
                        echo("email: ". $email . "<br>");
                        echo("group: ". $usergroup . "<br>");
                        $sql = "UPDATE users SET nickname = '$nickname', email = '$email', usergroup = '$usergroup' WHERE id = $id;";
                        echo $sql;
                        include("../includes/connect.inc.php");
                        $stmt = mysqli_query($connNP,$sql);
                        $connNP->close();
                        
                        header("location: ./?page=users");
                        exit();
                    }
                    header("location: ./?page=users");
                    exit();
                }
                header("location: ./?page=users");
                exit();
            }
            header("location: ./?page=users");
            exit();
        }
        header("location: ./?page=users");
        exit();
    }else{
        header("location: ./?page=users");
        exit();
    }
?>