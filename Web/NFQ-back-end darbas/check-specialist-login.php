<?php
session_start();
if(isset($_POST["Name"]) && isset($_POST["Password"])) {

    include_once ("model_view_controller.php");
    $result = get_user_password($_POST["Name"]);
    $hash = $result->fetch_assoc();
    $password = $_POST["Password"];

    if(password_verify ( $password,  $hash["password"])){
        //echo "im in";
        //session_destroy();
        $username1 = $_POST["Name"];
        $_SESSION["specialist_logged_in"] = "true";
        $_SESSION["logged_in_specialist"] = $username1;
        echo'true';
    }
    else{
      echo'Netinka slaptazodis';
    }
}
else{
  echo 'viskas labai negerai';
}

?>
