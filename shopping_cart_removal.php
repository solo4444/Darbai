<?php
include_once ("model_view_controller.php");

$cookie_name = "shopping-cart-tracker";
$cookie_value = "";
$product_name = isset($_POST["product_name"]) ? $_POST["product_name"] : "";
$product_info = get_product_data($product_name);
$rado = 0;

if(!empty($_COOKIE[$cookie_name])){
    $array = explode(";",$_COOKIE[$cookie_name]);
    foreach ($array as $pavadinimas) {
        //$row = get_product_data($pavadinimas);
        if($product_name == $pavadinimas ){
            $rado++;
        }
        else if($product_name != $pavadinimas){
            $cookie_value = $cookie_value . $pavadinimas . ";";
        }

    }
    echo $rado . "items removed";
    setcookie($cookie_name , $cookie_value, time() + (86400*30), '/');
}


?>
