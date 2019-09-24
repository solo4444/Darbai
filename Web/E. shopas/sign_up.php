<?php
include_once ("model_view_controller.php");

$conn = connect_to_db('user_info');

if(isset($_POST["UserEmail"])){
    $Email = mysqli_real_escape_string($conn,$_POST["UserEmail"]);
}
if(isset($_POST["UserUsername"])){
    $Username = mysqli_real_escape_string($conn,$_POST["UserUsername"]);
}
if(isset($_POST["UserPassword"])){
    $Password = mysqli_real_escape_string($conn,$_POST["UserPassword"]);
}

$hash = password_hash($Password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (Email, Username, Password) VALUES ('$Email' , '$Username' , '$hash')";

$sql_check_email = "SELECT Email FROM users";
$sql_check_username = "SELECT Username FROM users"

if($conn->query($sql_check_email) === TRUE){
    echo "This email is already in use";
}
else if($conn->query($sql_check_username) === TRUE){
    echo "This username is already in use";
}
else if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
