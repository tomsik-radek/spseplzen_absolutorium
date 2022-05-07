    <div class="outercontainer">
        <div class="topnav">
        <?php
            include("../includes/topnav.inc.php");
        ?>
        </div class="topNav">
        <div class="innercontainer">    
            <?php
            if(isAdmin($_SESSION["userinfo_usergroup"])){
                //include("../admin/includes/adminNav.inc.php");
            }
                if(isset($_GET["page"])){
                    if($_GET["page"] === "list"){
                        include("../tickets/index.php");
                        if(isset($_SESSION["data_adminQuery"])){
                            unset($_SESSION["data_adminQuery"]);
                        }
                    }
                    if($_GET["page"] === "users"){
                        if (isAdmin($_SESSION["userinfo_usergroup"])) {
                            include("../admin/userindex.php");
                        }
                        else{
                            header("location: ./?page=list");
                            exit();
                        }
                    }
                    if($_GET["page"] === "edit"){
                        include("../tickets/editForm.php");
                    }
                    if($_GET["page"] === "new"){
                        include("../tickets/newTicket.php");
                    }
                    if($_GET["page"] === "settings"){
                        ?>
                        <?php
                        header("location: ../settings/index.php");
                        exit();
                    }
                    if(isset($_GET["action"])){
                        if($_GET["action"] === "filter"){
                            include("../tickets/edit/editFlagApply.inc.php");
                        }
                    }
                }elseif($_GET["action"] === "appendticket"){
                    include("../tickets/edit/appendTicket.inc.php");
                }elseif($_GET["action"] === "reassignticket"){
                    include("../tickets/edit/reassignTicket.inc.php");
                }elseif($_GET["action"] === "new"){
                    include("../tickets/includes/newTicket.inc.php");
                }elseif($_GET["action"] === "resetPassword"){
                    if(isAdmin($_SESSION["userinfo_usergroup"])){
                        include("../admin/resetPassword.php");
                    }
                }elseif($_GET["action"] === "sendrecmail"){
                    if(isAdmin($_SESSION["userinfo_usergroup"])){
                        include("../login/passwordrecovery/sendmail.inc.php");
                    }
                }elseif($_GET["action"] === "viewTickets"){
                    if(isAdmin($_SESSION["userinfo_usergroup"])){
                        include("../admin/includes/viewAdminTicket.inc.php");
                    }
                }elseif($_GET["action"] === "editUser"){
                    if(isAdmin($_SESSION["userinfo_usergroup"])){
                        include("../admin/editUser.php");
                    }
                }elseif($_GET["action"] === "saveUserChanges"){
                        if(isAdmin($_SESSION["userinfo_usergroup"])){
                            include("../admin/includes/saveUserChanges.inc.php");
                        }
                }else{
                    header("location: ./?page=list");
                    exit();
                }
                    
            ?>
        </div class="innercontainer">
    </div class="outercontainer">