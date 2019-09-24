<?php
include_once  ("model_view_controller.php");

if(isset($_POST["category"])){
    $results = get_filter_by_category($_POST["category"]);

    while($row = $results->fetch_assoc()){
        include ("product_cards.php");
    }
}
 ?>
