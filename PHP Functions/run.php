<?php
require "Mysql.php";
require "GrabbingAnimals.php";

if ($_GET['type'] == "GrabbingAnimals") {
  $GrabbingAnimals = new GrabbingAnimals();
  echo $GrabbingAnimals->run();
}

?>