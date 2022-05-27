
    <div class="center-screen">
        <div class="outercontainer">
            <div class="innercontainer">
                <fieldset>
                    <div class="header-image">
                        <img src="../img/corplogo.png"></img>                    
                    </div>
                    <div class="flex-container titles">
                        <div class="login-title flex-child">
                            Forgot password
                        </div>
                        <div class="register-button">
                            <a href="./?page=login">Log in</a>
                        </div>
                    </div>
                    <form method="POST" action="./?action=sendrecmail">
                        <div class="email-box">
                            <label class="custLabel" for="email">Enter your registered email address</label>
                            <input name="inputemail" type="text" required></input>
                        </div>
                        <div>                 
                            <button class="pswdreset-button" type="submit">Reset password</button>
                        </div>
                    </form>
                    <div class="errormessage">
                        <?php
                            if(isset($_GET["msg"])){
                                if($_GET["msg"] === "emailsent"){
                                    echo("Reset email sent. Please check your inbox.<br>Link will be valid for 15 minutes");
                                }
                                if($_GET["msg"] === "emailnotsent"){
                                    echo("Reset email NOT sent. Please contact an administrator!");
                                }
                                if($_GET["msg"] === "usernotexist"){
                                    echo("No user with this email exists. Please try again.");
                                }
                            }
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