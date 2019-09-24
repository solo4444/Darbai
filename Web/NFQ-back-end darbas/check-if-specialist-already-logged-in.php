<?php
session_start();
if(isset($_SESSION["specialist_logged_in"]) && isset($_SESSION["logged_in_specialist"])){
  if( $_SESSION["specialist_logged_in"] == "true"){
    //echo"true";
    echo $_SESSION["specialist_logged_in"];
  }
}
?>
