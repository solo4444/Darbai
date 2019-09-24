<?php
session_start();
if(isset($_POST["Name"]) && isset($_POST["Password"])){
  include_once("model_view_controller.php");
  $result = get_user_password($_POST["Name"])->fetch_assoc();
   $password = $_POST["Password"];

   if($password == $result["password"]){
     //session_destroy();
     $_SESSION["admin_logged_in"] = "true";
      echo'true';
   }
}
 ?>
