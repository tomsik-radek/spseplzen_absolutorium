<?php
    include("./passwordrecovery/token_selector_validation.php");
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // print_r($_SESSION);
?>
    <div class="center-screen">
        <div class="outercontainer">
            <div class="innercontainer">
                <fieldset>
                    <div class="header-image">
                        <img src="../img/corplogo.png"></img>                    
                    </div>
                    <div class="flex-container titles">
                        <div class="login-title flex-child">
                            Password reset
                        </div>
                        <div class="register-button">
                            <a href="./?page=login">Log in</a>
                        </div>
                    </div>
                    <form method="POST" action="./?page=pswdrecovery">
                        <div class="email-box">
                            <label class="custLabel" for="acc">Email</label>
                            <input name="email" type="text" readonly value="<?php echo $resetEmail;?>"></input>
                        </div>
                        <div class="email-box">
                            <label class="custLabel" for="password1">Enter your new password</label>
                            <input name="password1" type="password" required></input>
                        </div>
                        <div class="email-box">
                            <label class="custLabel" for="password2">Repeat your new password</label>
                            <input name="password2" type="password" required></input>
                        </div>
                        <div>
                            <div>                      
                                <button class="pswdreset-button" type="submit">Reset password</button>
                            </div>
                        </div>
                    </form>
                    <div class="errormessage">
                        <?php
                            include("./includes/gethandlers.login.inc.php");
                        ?>
                    </div class="errormessage">
                </fieldset>
            </div class="innercontainer">
        </div class="outercontainer">
    </div class="center-screen">
    <?php
        include("footer.php");
    ?>


<style>
    .pswdreset-button{
        text-align: center;
        width: 160px;
        height: 32px;
        margin-bottom: 0px;
        font-size: 1.1em;
        float: right;
    }

    form{
        margin-bottom: 64px;
    }
</style>