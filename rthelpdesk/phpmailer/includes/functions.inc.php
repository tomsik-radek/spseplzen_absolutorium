<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function render_php($path)
{
    ob_start();
    include($path);
    $var=ob_get_contents(); 
    ob_end_clean();
    return $var;
}

class phpMail{
    public static function sendMail($mailRecipient,$mailSubject,$filePath){
        //Create an instance of phpmailer
        $mail = new PHPMailer();
        //Set phpmailer to use SMTP
        $mail->isSMTP();
        //Define SMTP host
        $mail->Host = $_SESSION["phpmailer_smtpHost"];
        //enable SMTP auth
        $mail->SMTPAuth = "true";
        //Set encryption type
        $mail->SMTPSecure = "tls";
        //Set port to connect smtp
        $mail->Port = $_SESSION["phpmailer_smtpPort"];
        //Set mail username
        $mail->Username = $_SESSION["phpmailer_username"];
        //Set mail password 
        $mail->Password =  $_SESSION["phpmailer_password"];
        //Set mail subject
        $mail->Subject = $mailSubject;
        //Set sender email
        //$mail->setFrom("no-reply@tomsikr.fun");
        $mail->setFrom($_SESSION["phpmailer_setfrom"]);
        $mail->isHTML(true);
        //Add recipient
        $mail->addAddress($mailRecipient);

        $mailBody = render_php($filePath);

        echo("********************<br>");
        echo("Host: " . $_SESSION["phpmailer_smtpHost"] . "<br>"); 

        //echo $mailBody . "<br>";

        $mail->msgHTML($mailBody);

        if($mail->Send()){
            echo "email sent to $mailRecipient <br>";
        }else{
            echo "email not sent because: $mail->ErrorInfo <br>";
            header("location: ../login/?page=passwordreset&msg=emailnotsent");
            exit();
        }
        echo("********************<br>");
    }
}

?>
