<?php
include 'model_view_controller.php';
if(isset($_SESSION["logged_in_specialist"])){
$results = get_eiles_info_by_specialist($_SESSION["logged_in_specialist"]);
echo'<div class="row eiles-card-info border">
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
  <div class="col border-right text-center">
    Prognozuojamas Laikas
  </div>
  <div class="col text-center">
    Veiksmai
  </div>
</div>';
while($row = $results->fetch_assoc()){
  //print_r($row["Vardas"]);
  $pLaikas = get_waiting_time($row["Specialistas"],$row["Vardas"], $row["Pavarde"]);
  echo'
  <div class="row eiles-card-info border">
    <div class="col border-right text-center vardas">
      '.$row["Vardas"].'
    </div>
    <div class="col border-right text-center pavarde">
      '.$row["Pavarde"].'
    </div>
    <div class="col border-right text-center">
      '.$row["Laikas"].'
    </div>
    <div class="col border-right text-center">
      '.$row["Specialistas"].'
    </div>
    <div class="col border-right text-center">
      '.$pLaikas.'
    </div>
    <div class="col text-center d-inline-block">
    <button class="btn btn-primary aptarnauti" type="submit">Aptarnauti</button>
    <button class="btn btn-danger istrinti" type="submit">Ištrinti</button>
    </div>
  </div>';

}
}
 ?>
