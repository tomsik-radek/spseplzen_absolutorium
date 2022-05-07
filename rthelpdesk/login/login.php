<?php
    /*session_unset();
    print_r($_SESSION);
    echo("hello there");
    */
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
                            Log in
                        </div>
                        <div class="register-button">
                            <a href="./?page=register">Register</a>
                        </div>
                    </div>
                    <form method="POST" action="./?action=login">
                        <div class="email-box">
                            <label class="custLabel" for="email">Email</label>
                            <input name="inputemail" type="text" required></input>
                        </div>
                        <div class="password-box">
                            <label class="custLabel" for="password">Password</label>
                            <input name="inputpassword" type="password" required></input>
                        </div>
                        <div>
                            <div>                      
                                <button class="login-button buttons" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                    <div class="forgotpassword-button buttons">
                        <a href="./?page=passwordreset">Forgot password</a>
                        <a href="./?action=changetheme"><img style="vertical-align: bottom; margin-left: 8px;" src="../img/icons/32px_sun.png" height="24px" width="24px"></img></a>
                    </div>
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
