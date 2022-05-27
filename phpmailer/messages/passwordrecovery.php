<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $url = $_SESSION["passwordrecoveryurl"];
?>

<body>
    <div class="outsideContainer">
        <fieldset>
            <p class="title">We have received a password reset request for your account.</p>
            <p class="link"> The link to reset your password is: <a href='<?php echo $url;?>'><?php echo $url?></a><br></p>
            <p>If you did not request this, you can safely ignore this email</p>
        </fieldset>
    </div>
</body>

<style type="text/css">
    .outsideContainer{  
        box-sizing: border-box;
    }

    body{
        width: 100%;
        text-align: center;
        margin: 0;
        padding: 0;
    }

    .title{
        font-size: 2em;
        margin-bottom: 64px;
    }

    .link{
        font-size: 1.6em;
    }

</style>