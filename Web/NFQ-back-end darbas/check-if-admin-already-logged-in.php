<?php
session_start();
if(isset($_SESSION["admin_logged_in"])){
  if( $_SESSION["admin_logged_in"] == "true"){
    //echo"true";
    echo $_SESSION["admin_logged_in"];
  }
} ?>
