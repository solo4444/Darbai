<?php
session_start();
if(isset($_POST["new_email"]) && isset($_POST["password"]) && isset($_POST["new_password"])){
    include ("model_view_controller.php");
    $Username = $_SESSION["logged_in_user"];
    $result = get_user_password($Username);
    $hash = $result->fetch_assoc();
    $password = $_POST["password"];

    if(password_verify ( $password,  $hash["Password"])){

        $conn = connect_to_db('user_info');
        $Email = mysqli_real_escape_string($conn,$_POST["new_email"]);
        $hashNew = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET Email ='$Email' , Password = '$hashNew' WHERE Username = \"$Username\"";

        $sql_check_email = "SELECT Email FROM users";

        if($conn->query($sql_check_email) === TRUE){
            echo "This email is already in use";
        }
        else if ($conn->query($sql) === TRUE) {
            echo "Paskyros informacija atnaujinta";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
 ?>
