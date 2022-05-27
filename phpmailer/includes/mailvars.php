<?php
    $sql = "SELECT * FROM phpmailer";
    //echo $sql . "<br>";
    $stmt = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($stmt)){
        $_SESSION["phpmailer_smtpHost"] = $row["smtphost"];
        $_SESSION["phpmailer_encryptType"] = $row["encrypttype"];
        $_SESSION["phpmailer_smtpPort"] = $row["smtpport"];
        $_SESSION["phpmailer_username"] = $row["mailusername"];
        $_SESSION["phpmailer_password"] = $row["mailpassword"];
        $_SESSION["phpmailer_setfrom"] = $row["setFrom"];
    }
    mysqli_close($conn);
?>