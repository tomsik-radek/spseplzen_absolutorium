<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    //echo "sending email <br>";
    $sendmail = new phpMail();
    $sendmail->sendMail($inputemail,$mailSubject,$filePath);
    //$sendmail->sendMail2($inputemail,$mailSubject,$filePath);