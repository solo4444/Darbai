<?php
if(isset($_POST["Pin"])){
  if($_POST["Pin"] == "4444"){
include_once ("model_view_controller.php");

$conn = connect_to_db('user_info');

if(isset($_POST["Name"])){
    $Username = mysqli_real_escape_string($conn,$_POST["Name"]);
}
if(isset($_POST["Password"])){
    $Password = mysqli_real_escape_string($conn,$_POST["Password"]);
}

$hash = password_hash($Password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES ('$Username' , '$hash')";

$sql_check_username = "SELECT username FROM users";

if($conn->query($sql_check_username) === TRUE){
    echo "Toks specialistas jau yra";
}
else if ($conn->query($sql) === TRUE) {
    echo "Specialistas " . $Username . " uzregistruotas sėkmingai!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
  }
  else{
    echo 'Neteisingas PIN kodas!';
  }
}
else{
  echo'Iveskite PIN koda!';
}

?>
