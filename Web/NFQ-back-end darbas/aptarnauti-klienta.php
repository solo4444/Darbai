<?php
session_start();
include 'model_view_controller.php';
if(isset($_POST["Vardas"]) && isset($_POST["Pavarde"])){
  $name = $_POST["Vardas"];
  $surname = $_POST["Pavarde"];
  $sql = "UPDATE laukiantys SET Aptarnautas = 1 WHERE Vardas = '$name' AND Pavarde = '$surname'";
  // $sql = "DELETE FROM laukiantys WHERE Vardas = '$name' AND Pavarde = '$surname'";
  $conn = connect_to_db("eiles_info");
  if($conn->query($sql) === TRUE){
    echo 'Aptarnauta sekmingai';
    add_service_time($name, $surname);
  }
  else{
    echo 'Nepavyko aptarnauti';
  }

}
 ?>
