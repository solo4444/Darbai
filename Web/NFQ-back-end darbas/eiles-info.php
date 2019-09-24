<?php
include 'model_view_controller.php';
if(isset($_GET["kiek"])){
  $results = get_eiles_info($_GET["kiek"]);
}else{
$results = get_eiles_info(10);
}



echo '<div class="row eiles-card-info border">
  <div class="col border-right text-center">
    Vardas
  </div>
  <div class="col border-right text-center">
    Pavarde
  </div>
  <div class="col border-right text-center">
    Uzregistruotas Laikas
  </div>
  <div class="col border-right text-center">
    Specialistas
  </div>
  <div class="col text-center">
    Kiek liko laukti
  </div>
</div>';
if($results){
while($row = $results->fetch_assoc()){
  $pLaikas = get_waiting_time($row["Specialistas"],$row["Vardas"], $row["Pavarde"]);
  //print_r($row["Vardas"]);
  include ("eiles-card.php");

}
}
 ?>
