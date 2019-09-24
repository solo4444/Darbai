<?php
if(isset($_POST["pavadinimas"]) && isset($_POST["kaina"]) && isset($_POST["aprasymas"]) && isset($_POST["kategorija"]) && isset($_POST["nuotrauka"]) && isset($_POST["og_pavadinimas"])){
    include ("model_view_controller.php");
    $conn = connect_to_db('product_info');
    $pavadinimas = mysqli_real_escape_string($conn,$_POST["pavadinimas"]);
    $kaina = mysqli_real_escape_string($conn,$_POST["kaina"]);
    $aprasamymas = mysqli_real_escape_string($conn,$_POST["aprasymas"]);
    $kategorija = mysqli_real_escape_string($conn,$_POST["kategorija"]);
    $nuotrauka = mysqli_real_escape_string($conn,$_POST["nuotrauka"]);
    $og_pavadinimas = mysqli_real_escape_string($conn,$_POST["og_pavadinimas"]);

    $sql = "UPDATE products SET Pavadinimas ='$pavadinimas' , Kaina = '$kaina' , Aprasymas = '$aprasamymas', Kategorija = '$kategorija', Nuotrauka = '$nuotrauka' WHERE Pavadinimas = \"$og_pavadinimas\"";


    if ($conn->query($sql) === TRUE) {
        echo "Produkto informacija atnaujinta";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}
else{
    echo 'Neuzpildyti visi privalomi laukai';
}
?>
