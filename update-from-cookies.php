<?php
include_once ("model_view_controller.php");

$cookie_name = "shopping-cart-tracker";

if(!empty($_COOKIE[$cookie_name])){

    $array = explode(";",$_COOKIE[$cookie_name]);

    foreach ($array as $pavadinimas) {
        if($pavadinimas != null){
            $row = get_product_data($pavadinimas);
            $message = $pavadinimas;
            echo "<script type='text/javascript'>alert('$message');</script>";
            include ("product_card_in_cart.php");
        }
    }

}
?>
