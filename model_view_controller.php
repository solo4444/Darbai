<?php
function connect_to_db($dbname){

    $servername = "localhost:3307";
    $username = "root";
    $password = "root";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}


function get_products_data(){
    $sql = "SELECT ID, Pavadinimas, Aprasymas, Nuotrauka, Kaina, Ivertinimas, Kategorija FROM products";
    $result = connect_to_db("product_info")->query($sql);
    if($result){
    return $result;
    }
    else {
        echo connect_to_db("product_info")->error;
    }
}
function get_product_data($pavadinimas){
    $row = "";
    $sql = "SELECT ID, Pavadinimas, Aprasymas, Nuotrauka, Kaina, Ivertinimas, Kategorija FROM products";
    $result = connect_to_db("product_info")->query($sql);
    while($row = $result->fetch_assoc()){
        // $message = $row["Pavadinimas"];
        // echo "<script type='text/javascript'>alert('$message');</script>";
    if($row["Pavadinimas"] == $pavadinimas){
    return $row;
    }
    else{
        echo connect_to_db("product_info")->error;
    }
}
}
function get_filter_by_category($category)
{
    $sql = "SELECT ID, Pavadinimas, Aprasymas, Nuotrauka, Kaina, Ivertinimas, Kategorija FROM products WHERE kategorija = \"$category\"";
    $result = connect_to_db("product_info")->query($sql);
    if($result){
    return $result;
    }
    else {
        echo connect_to_db("product_info")->error;
    }
}
function get_user_password($username){
    //var_dump($username);
    $sql = "SELECT Password FROM users WHERE Username = \"$username\"";
    $result = connect_to_db("user_info")->query($sql);
    if($result){
    return $result;
    }
    else {
        echo connect_to_db("user_info")->error;
    }

}
function get_user_info_by_username($username)
{
    $sql = "SELECT Email FROM users WHERE Username = \"$username\"";
    $results = connect_to_db("user_info")->query($sql);
    if($results){
    return $results;
    }
    else {
        echo connect_to_db("user_info")->error;
    }
}
function get_product_rating_average($pavadinimas)
{
    $conn = connect_to_db("product_info");
    $sql = "SELECT AVG(Ivertinimas) AS Ivertinimo_vidurkis FROM produkto_komentarai WHERE Produktas = \"$pavadinimas\"";
    $result = $conn->query($sql);
    if($result){
    return $rating = $result->fetch_assoc();
    }

}

?>
