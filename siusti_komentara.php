<?php
session_start();

    if(isset($_POST["Produktas"]) && isset($_POST["Komentaras"]) && isset($_POST["Reitingas"]) && isset($_POST["Data"])){
        include ("model_view_controller.php");
        $conn = connect_to_db('product_info');
        $produktas = $_POST["Produktas"];
        $username = $_SESSION["logged_in_user"];
        $komentaras = $_POST["Komentaras"];
        $reitingas = $_POST["Reitingas"];
        $data = $_POST["Data"];
        $sql = "INSERT INTO produkto_komentarai (Produktas, Username, Komentaras, Ivertinimas, Data) VALUES ('$produktas' , '$username' , '$komentaras' ,'$reitingas' ,'$data')";

        if($conn->query($sql) === TRUE){
            echo "Komentaras issiustas sekmingai!";
        }else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
 ?>
