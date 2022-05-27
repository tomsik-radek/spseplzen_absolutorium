<!DOCTYPE html>
<html lang="en">
  <head>
  </head>
  <body>
  <form method="POST" action="./includes/login.inc.php">
    <input name="input" type="text">
    <input type="submit">
  </form>
  <form method="POST" action="./index.php?action=login">
    <input name="input" type="text">
    <input type="submit">
  </form>
  <?php 
    if(isset($_GET["action"])){
      if($_GET["action"] === "login"){
        include("./includes/login.inc.php");
      }
    }
  ?>
  </body>
</html>