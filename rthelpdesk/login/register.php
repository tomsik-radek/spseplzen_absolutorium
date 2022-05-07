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
                            Register
                        </div>
                        <div class="register-button">
                            <a href="./?page=login">Log in</a>
                        </div>
                    </div>
                    <form method="POST" action="./?action=register">
                        <div class="email-box">
                            <label class="custLabel" for="name">Name</label>
                            <input name="inputname" type="text" required></input>
                        </div>
                        <div class="email-box">
                            <label class="custLabel" for="email">Email</label>
                            <input name="inputemail" type="text" required></input>
                        </div>
                        <div class="password-box" style="margin-bottom: 16px;">
                            <label class="custLabel" for="password">Password</label>
                            <input name="inputpassword1" type="password" required maxlength="32"></input>
                        </div>
                        <div class="password-box">
                            <label class="custLabel" for="password">Repeat password</label>
                            <input name="inputpassword2" type="password" required maxlength="32"></input>
                        </div>
                        <div style="margin-bottom: 32px;">
                            <div style="float: right">                      
                                <button class="login-button buttons" type="submit">Register</button>
                            </div>
                            <div>
                                <input name="tosbox" type="checkbox" required>I accept <a href="#">ToS</a></input>
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
