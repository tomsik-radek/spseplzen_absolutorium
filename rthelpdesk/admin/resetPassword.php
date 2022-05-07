<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_GET["id"])){
        //echo("changing user ". $_GET['id'] . " <br>");
        $userid = $_GET["id"];
    }else{
        header("location: ./?page=list");
        exit();
    }
    include("../includes/connect.inc.php");
    $sql = "SELECT email FROM users WHERE id = $userid;";
    //echo $sql;
    $stmt = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($stmt)){
        $email = $row["email"];
    }
?>

<div>
    <div>
        <form method="POST" action="./?action=sendrecmail&return=admin">
            <div class="settings_passwordChangeForm">
                <div class="settings_input">
                    <label class="custLabel" for="email" >Email</label>
                    <input name="inputemail" type="text" required value="<?php echo($email);?>"></input>
                </div>
                <div>                 
                    <button class="pswdreset-button" type="submit">Send reset link</button>
                </div>
            </div>
        </form>
    </div>
</div>
