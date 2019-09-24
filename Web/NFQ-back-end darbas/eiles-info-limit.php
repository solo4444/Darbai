<?php
if(isset($_GET["Kiek"]))
{
  if($_GET["Kiek"] == 10){
    echo '10';
  }
  else if($_GET["Kiek"] == 15){
    echo '15';
  }
  else {
    echo "30";
  }
}
?>
