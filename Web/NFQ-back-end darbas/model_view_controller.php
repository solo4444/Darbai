<?php

include_once("config.php");

function get_user_password($username){
    $sql = "SELECT password FROM users WHERE Username = \"$username\" ";
    $result = connect_to_db("user_info")->query($sql);
    if($result){
    return $result;
    }
    else {
        echo connect_to_db("user_info")->error;
    }

}
function get_customer_pin($name, $surname){
    $sql = "SELECT pin FROM customer_links WHERE Vardas = \"$name\" AND Pavarde = \"$surname\"";
    $result = connect_to_db("user_info")->query($sql);
    if($result){
    return $result;
    }
    else {
        echo connect_to_db("user_info")->error;
    }

}
function get_eiles_info($kiek){

    $sql = "SELECT Vardas, Pavarde, Laikas, Specialistas,PLaikas FROM laukiantys WHERE Aptarnautas = 0 ORDER BY Laikas ASC LIMIT $kiek";
    $result = connect_to_db("eiles_info")->query($sql);
    if($result){
    return $result;
    }
    else {
        echo connect_to_db("eiles_info")->error;
    }
}
function get_eiles_info_by_specialist($name)
{
  $sql = "SELECT Vardas, Pavarde, Laikas, Specialistas,PLaikas FROM laukiantys WHERE Specialistas = '$name' AND Aptarnautas = 0 ORDER BY Laikas ASC";
  $result = connect_to_db("eiles_info")->query($sql);
  if($result){
  return $result;
  }
  else {
      echo connect_to_db("eiles_info")->error;
  }
}
function get_eiles_info_by_customer($name, $surname)
{
  $sql = "SELECT Vardas, Pavarde, Laikas, Specialistas,PLaikas FROM laukiantys WHERE Vardas = '$name' AND Pavarde = '$surname' ";
  $result = connect_to_db("eiles_info")->query($sql);
  if($result){
  return $result;
  }
  else {
      echo connect_to_db("eiles_info")->error;
  }
}
function get_customer_url($name, $surname, $pin)
{
  $sql = "SELECT url FROM customer_links WHERE Vardas = '$name' AND Pavarde = '$surname' AND pin = '$pin' ";
  $result = connect_to_db("user_info")->query($sql);
  if($result){
  return $result;
  }
  else {
      echo connect_to_db("user_info")->error;
  }
}
function add_service_time($name, $surname)
{

  $sql = "SELECT Laikas, Specialistas FROM laukiantys WHERE Vardas = '$name' AND Pavarde = '$surname' ";
  $result = connect_to_db("eiles_info")->query($sql);

  if($result){
    date_default_timezone_set("Europe/Vilnius");
    $row = $result->fetch_assoc();

    $delta_time = time() - strtotime($row["Laikas"]) - 60*60*3;

    $apsilankymo_laikas = date("H:i:s", $delta_time);
    //echo $apsilankymo_laikas;

    $specialistas = $row["Specialistas"];
    $sql1 = "INSERT INTO laukimo_info (Vardas, Pavarde, Apsilankymo_laikas, Specialistas) VALUES ('$name', '$surname', '$apsilankymo_laikas', '$specialistas')";
    if(connect_to_db("eiles_info")->query($sql1) === TRUE){

    }
    else{

      echo connect_to_db("eiles_info")->error;
    }
  }
  else{
    echo connect_to_db("eiles_info")->error;
  }
}
function get_waiting_time($specialistas, $vardas, $pavarde)
{
  date_default_timezone_set("Europe/Vilnius");
  $sql = "SELECT Apsilankymo_laikas FROM laukimo_info WHERE Specialistas = '$specialistas'";
  $result = connect_to_db("eiles_info")->query($sql);
  if($result){
    $i = 0;
    $date = date_create();
    date_time_set($date, 0, 0);
    //$b = "00:00:00";
    $b = date_format($date, 'H:i:s');
    $bendras_laikas = strtotime($b);
    while($row = $result->fetch_assoc()){
      $bendras_laikas += strtotime($row["Apsilankymo_laikas"])  ;
      $i++;
    }
    $bendras_laikas = $bendras_laikas / $i;
    $prognozuojamas_laikas = date("H:i:s" ,$bendras_laikas);
    $sql1 = "UPDATE laukiantys SET PLaikas = '$prognozuojamas_laikas' WHERE Vardas = '$vardas' AND Pavarde = '$pavarde' AND Specialistas = '$specialistas'";
    if(connect_to_db("eiles_info")->query($sql1) === TRUE){
      return $prognozuojamas_laikas;
    }
  }
}

?>
