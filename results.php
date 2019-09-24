<?php

include_once  ("model_view_controller.php");

$results = get_products_data();

//print_r($results);

while($row = $results->fetch_assoc()){
    //print_r ($row);
    include ("product_cards.php");
    
}

?>
