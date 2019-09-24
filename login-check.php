<?php
session_start();
if(isset($_POST["user_username"]) && isset($_POST["user_password"])) {

    include_once ("model_view_controller.php");
    $result = get_user_password($_POST["user_username"]);
    $hash = $result->fetch_assoc();
    $password = $_POST["user_password"];

    if(password_verify ( $password,  $hash["Password"])){
        //echo "im in";
        $username1 = $_POST["user_username"];        $_SESSION["logged_in"] = "true";
        //echo"{$_SESSION['logged_in']}"."<br />";
        $_SESSION["logged_in_user"] = $username1;
        if($_SESSION["logged_in_user"] == "kabakaba"){
            $_SESSION["show_admin"] = "true";
        }
        else{
            $_SESSION["show_admin"] = "false";
        }

        //print_r($_SESSION);

    }
}

?>
