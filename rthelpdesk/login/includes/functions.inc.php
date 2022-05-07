<?php
    /*Checks if any of 3 input strings is empty
        @param string $email
        @param string $password
        @param string $repeatpassword
        @return boolean true/false
    */
    function emptyInputSignup($email, $pswd, $repeatPswd){
        $result = true;
        if(empty($email) || empty($pswd) || empty($repeatPswd)){
            $result = true;
            exit();
        }else{
        $result = false;
        }
        return $result;
    }

    /*Email validity checked. Using built in PHP filter
        https://www.php.net/manual/en/filter.filters.validate.php#:~:text=alphanumerics%20or%20hyphens).-,FILTER_VALIDATE_EMAIL,-%22validate_email%22
        @param string $email
        @return boolean true/false
    */
    function isValidMail($email){
        $result = false;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        }else{
            $result = true;
        }
        return $result;
    }

    /*Checks if two strings, in this case two passwords, match
        @param string $password1
        @param string $password2
        @return boolean true/false
    */
    function pswdMatch($pswd, $repeatPswd){
        if($pswd === $repeatPswd){
            return true;
        }else{
            return false;
        }   
    }

    /*Checks if string, in this case password, meets certain requirements
        @param string $password
        @return boolean true/false 
        In this case the only parameter is lenght, higher or equal to 8
    */
    function pswdReqs($pswd){
        $result = false;
        if(strlen($pswd) >= 8){
            $result = true;
        }else{
            $result = false;
        }
        return $result;
    }

    /*Encrypts entered password before any other action
        @param string $unencryptedpassword
        @return string $encryptedpassword
    */
    function encryptPassword($unencrypted){
        return hash('sha256',$unencrypted);
    }

    /*Checks if user exists in the database, checks by email
        @param databaseconnection $conn
        @param string email
        @return boolean true/false
    */
    function userExists($conn,$email){
        $result = false;
        require("../includes/connect.inc.php");
        $sql = "SELECT * FROM `users` WHERE `email` = ?";
        //echo "User exists sql: $sql <br>";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$email);
        if($stmt->execute()){
            echo("success <br>");
        }else{
            echo("fail <br>");
        }
        $stmt = $stmt->get_result();
        while($row = mysqli_fetch_assoc($stmt)){
            if($email === $row["email"]){
                $result = true;
                echo "$email match found <br>";
            }else{
                $result = false;
                echo "$email not found <br>";
            }
        }
        mysqli_close($conn);
        return $result;
    }

    /*Checks if all login info is correct so that user can log in
        @param databaseconnection $conn
        @param string $email
        @param string $password
        @return boolean true/false
     */
    function loginUser($conn,$email,$pswd){
        $result = false;
        $encryptedpassword = encryptPassword($pswd);
        $sql = "SELECT * FROM `users` WHERE `email` = ?";
        echo "sql: $sql , email: $email <br>";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$email);
        if($stmt->execute()){
            echo("log success <br>"); //If user with that email exists then look for password match
            $sqlresult = $stmt->get_result();
            while($row = mysqli_fetch_assoc($sqlresult)){
                if($email === $row["email"]){
                    $result = true;
                    echo "$email match found <br>";
                    if($encryptedpassword === $row["encPass"]){
                        $result = true;
                        echo "encpswdmatch <br>";
                    }else{
                        $result = false;
                        echo "encpswdnomatch <br>";
                    }
                }else{
                    $result = false;
                    echo "$email not found <br>";
                }
            }
        }else{
            echo("log fail <br>");
            $result = false;
        } 
        echo "loginUser result $result <br>";
        return $result;
    }

    /*Creates a new user using entered and default values
        @param databaseconnection $conn
        @param string $name
        @param string $email
        @param string password
        @param string birthdate
    */
    function createUser($conn, $name, $email, $password, $birthdate){
        $encryptedPass = encryptPassword($password);
        date_default_timezone_set("Europe/Prague");
        //$registerTime = date("d-m-Y") . " " . date("H:i:s");
        $defaultUserGroup = "1";
        $defaulttheme = "light";
        $defaultlocale = "en_US";

        $timeZone = "Europe/Prague";
        $date = new DateTime("now", new DateTimeZone($timeZone) );
        $registerTime = $date   ->format('d-m-Y H:i:s');

        $stmt = $conn->prepare("INSERT into `users`(nickname,email,encPass,usergroup,birthDate,registerTime,active,theme,lang)
        VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssss",$name,$email,$encryptedPass,$defaultUserGroup,$birthdate,$registerTime,$defaultUserGroup,$defaulttheme,$defaultlocale);
        if ($stmt->execute()) {
            return true;
        }else{
            return false; // returns False if the query fails for some reason
        }
    }

    /*Changes password of a given user, user is search by their ID, not their email or nickname
        @param databaseconnection $conn
        @param string $userid
        @param string @newpassword
        @return boolean true/false
            returns false if query fails
    */
    function changePassword($conn,$userid,$newPass){
        $sql = "UPDATE users SET encPass=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss",$newPass,$userid);
        if($stmt->execute()){
            echo("pswd change query success <br>");
            return true;
        }else{
            echo("pswd change query fail <br>");
            return false;
        }
    }

    /*Checks if password already exists as new password cannot be the same as old password
        @param databaseconnection $conn
        @param string $email
        @param string $newpassword - already hashed password needs to be passed here
    */
    function pswdAlreadyExists($conn,$email,$newPass){
        $sql = "SELECT encPass FROM users WHERE email = ?";
        echo $sql . "<br>";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$email);
        if($stmt->execute()){
            echo("pmcheck success <br>");
            $result = $stmt->get_result();
            while($row = mysqli_fetch_assoc($result)){
                echo("oldpass: " . $row["encPass"] . "<br>");
                echo("newpass: $newPass <br>");
                if($row["encPass"] === $newPass){
                    echo("new password cannot be the same as old password <br>");
                    return true;
                }else{
                    echo("passwords don't match, good! <br>");
                    return false;
                }
            }
        }else{
            echo("pmcheck fail <br>");
            return true;
        }
    }

    /*Loads default session variables of a user
        @param databaseconnection $conn
        @param string @email
    */
    function loadUserPreferences($conn,$email){
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s",$email);
        if($stmt->execute()){
            echo("prefload success <br>");
            $result = $stmt->get_result();
            while($row = mysqli_fetch_assoc($result)){
                $_SESSION["userinfo_userid"] = $row["id"];
                $_SESSION["userinfo_email"] = $row["email"];
                $_SESSION["userinfo_usergroup"] = $row["usergroup"];
                $_SESSION["userinfo_lang"] = $row["lang"];
                $_SESSION["userinfo_theme"] = $row["theme"];
                $_SESSION["userinfo_nickname"] = $row["nickname"];
            }

            $timeZone = "Europe/Prague";
            $date = new DateTime("now", new DateTimeZone($timeZone) );
            $lastLogin = $date->format('d-m-Y H:i:s');

            //$lastLogin = date("d-m-Y") . " " . date("H:i:s");
            $sql = "UPDATE users SET `lastLogin` = STR_TO_DATE('$lastLogin', '%d-%m-%Y %H:%i:%s') WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s",$_SESSION["userinfo_userid"]);
            if($stmt->execute()){
                echo("lastlogin success");
            }else{
                echo("lastlogin fail");
            }
        }else{
            echo("prefload fail <br>");
        }
    }

?>