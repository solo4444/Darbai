<?php
if(isset($_POST["Name"]) && isset($_POST["Surname"]) && isset($_POST["Pin"])) {

    include_once ("model_view_controller.php");
    $result = get_customer_pin($_POST["Name"], $_POST["Surname"]);
    $row = $result->fetch_assoc();

    if($row["pin"] == $_POST["Pin"]){
      $_SESSION["logged_in_name"] = $_POST["Name"];
      $_SESSION["logged_in_surname"] = $_POST["Surname"];
      $url = get_customer_url($_POST["Name"], $_POST["Surname"], $_POST["Pin"]);
      $ats = $url->fetch_assoc();
    echo $ats["url"];
   }

    else{
      echo'Netinka pin';
    }
}
else{
  echo 'viskas labai negerai';
}
 ?>
