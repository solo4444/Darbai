<?php
session_start();
if(isset($_POST["what_to_show"]) && isset($_SESSION["show_admin"])){
    if($_POST["what_to_show"] == "admin"){
        $_SESSION["show_admin"] = "true";
        echo $_SESSION["show_admin"];
    }
    else{
        $_SESSION["show_admin"] = "false";
        echo $_SESSION["show_admin"];
    }
} ?>
