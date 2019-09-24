<?php
if(isset($_POST["pavadinimas"]) && isset($_POST["kaina"]) && isset($_POST["aprasymas"]) && isset($_POST["kategorija"]) && isset($_POST["nuotrauka"])){
    include ("model_view_controller.php");
    $conn = connect_to_db('product_info');
    $pavadinimas = mysqli_real_escape_string($conn,$_POST["pavadinimas"]);
    $kaina = mysqli_real_escape_string($conn,$_POST["kaina"]);
    $aprasymas = mysqli_real_escape_string($conn,$_POST["aprasymas"]);
    $kategorija = mysqli_real_escape_string($conn,$_POST["kategorija"]);
    $nuotrauka = mysqli_real_escape_string($conn,$_POST["nuotrauka"]);
    $sql = "INSERT INTO products (Pavadinimas, aprasymas, nuotrauka, kaina, kategorija) VALUES ('$pavadinimas','$aprasymas','$nuotrauka','$kaina','$kategorija')";
    if($conn->query($sql) === TRUE){
        echo "Produktas ikeltas sekmingai!";
    }else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "error! variable not set";
}?>
