<?php
include_once ("model_view_controller.php");

$conn = connect_to_db('eiles_info');
$conn1 = connect_to_db('user_info');

if(isset($_POST["Name"])){
    $name = mysqli_real_escape_string($conn,$_POST["Name"]);
}
if(isset($_POST["Surname"])){
    $surname = mysqli_real_escape_string($conn,$_POST["Surname"]);
}
if(isset($_POST["Specialist"])){
    $specialist = mysqli_real_escape_string($conn,$_POST["Specialist"]);
}
date_default_timezone_set("Europe/Vilnius");
//$time = date("Y-m-d-h-i-s");

$sql = "INSERT INTO laukiantys (Vardas, Pavarde, Specialistas) VALUES ('$name' , '$surname', '$specialist')";

$sql_check_name = "SELECT Vardas FROM eiles_info";
$sql_check_surname = "SELECT Pavarde FROM eiles_info";
$sql_check_specialist = "SELECT username FROM users";
$sql_check_url = "SELECT url FROM customer_links";

$random_pin = rand(1000,9999);
$random_url = "customer-panel.php?vardas=".$name."&pavarde=".$surname."&/".rand(1000000,9999999);

$sql_customer = "INSERT INTO customer_links (Vardas, Pavarde, url, pin) VALUES ('$name', '$surname', '$random_url', '$random_pin')";

if($conn->query($sql_check_name) === TRUE){
  if($conn->query($sql_check_username) === TRUE){
      echo "Toks klientas jau eilėje";
  }
}
else if($conn1->query($sql_check_specialist) === FALSE){
  echo 'Tokio specialisto nera!';
}
else if ($conn->query($sql) === TRUE) {
    echo $name . " " . $surname . " sėkmingai įrašytas į eilę";
    if($conn1->query($sql_customer) === TRUE){
      echo'!';
    }
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn1->close();
$conn->close();
 ?>
