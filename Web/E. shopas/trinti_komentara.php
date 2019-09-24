<?php
if(isset($_POST["Username"]) && isset($_POST["Komentaras"]) && isset($_POST["Reitingas"]) && isset($_POST["Data"])){
    include "model_view_controller.php";
    $conn = connect_to_db("product_info");
    $username = mysqli_real_escape_string($conn,$_POST["Username"]);
    $komentaras = mysqli_real_escape_string($conn,$_POST["Komentaras"]);
    $reitingas = mysqli_real_escape_string($conn,$_POST["Reitingas"]);
    $data = mysqli_real_escape_string($conn,$_POST["Data"]);
    $sql = "DELETE FROM produkto_komentarai WHERE Username='$username' AND Komentaras ='$komentaras' AND Ivertinimas='$reitingas' AND Data = '$data'";
    if ($conn->query($sql) === TRUE) {
        echo "Komentaras pasalintas!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
