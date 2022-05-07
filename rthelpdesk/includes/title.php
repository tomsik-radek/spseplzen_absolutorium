<?php
    if (isset($_GET["page"])) {
        if ($_GET["page"] === "login") {
            ?>
            <title>Log in</title>
            <?php
        } elseif ($_GET["page"] === "register") {
            ?>
                <title>Register</title>
            <?php
        } elseif ($_GET["page"] === "passwordreset") {
            ?>
                <title>Password Reset</title>
            <?php
        } elseif ($_GET["page"] === "dashboard") {
            ?>
                <title>Dashboard</title>
            <?php
        }elseif ($_GET["page"] === "list") {
            ?>
                <title>My Tickets</title>
            <?php
        }
    }
?>