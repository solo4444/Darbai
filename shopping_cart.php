<?php
include_once ("model_view_controller.php");

$cookie_name = "shopping-cart-tracker";
$cookie_value = "";
$product_name = isset($_POST["product_name"]) ? $_POST["product_name"] : "";
$product_info = get_product_data($product_name);

// $message = $product_name;
// echo "<script type='text/javascript'>alert('$message');</script>";

if(!isset($_COOKIE[$cookie_name])){
    $cookie_value =
      $product_name .
      ";";
      setcookie($cookie_name, $cookie_value, time() + (86400*30), '/');
       $_COOKIE[$cookie_name] = $cookie_value;
    $message1 = $_COOKIE[$cookie_name];
    //echo "$message1";
}
else if (isset($_COOKIE[$cookie_name])){
    $cookie_value =
    $_COOKIE[$cookie_name] .
      $product_name .
      ";";
    setcookie($cookie_name, $cookie_value, time() + (86400*30), '/');
    $_COOKIE[$cookie_name] = $cookie_value;
    $message1 = $cookie_value;
    //echo "$message1";
}
create_cart_box($product_info);


function create_cart_box($row)
{
    include ("product_card_in_cart.php");
}

function update_cart_count($cookie_name, $item_count)
{
    echo "<script type=\"text/javascript\">";
    echo "$(document).ready(function(){";
    echo "  $(\".item-counter\").text(\"".$item_count."\");";
    echo "});";
    echo "</script>";
}

?>
