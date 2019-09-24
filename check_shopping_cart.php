<?php

$cookie_name = "shopping-cart-tracker";

if(!empty($_COOKIE[$cookie_name])){
    $array = explode(";",$_COOKIE[$cookie_name]);
    $aryra = false;
    foreach ($array as $pavadinimas) {
        if($pavadinimas != null){
            $aryra = true;
        }
    }
    if($aryra){
    echo'<form class="checkout" action="" method="post">
        <input type="button" name="Patvirtinti uzskakyma" value="Patvirtinti uzskakyma" class="btn btn-success">
    </form>';
    }
    else{
        echo'<h3>Your shopping cart is empty!</h3>';
    }
}else{
    echo'<h3>Your shopping cart is empty!</h3>';
}
 ?>
