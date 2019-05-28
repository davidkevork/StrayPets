<?php
require "includeAll.php";

if ($_GET['type'] == "GrabbingAnimals") {
  $GrabbingAnimals = new GrabbingAnimals();
  echo $GrabbingAnimals->run();
} else if ($_GET['type'] == "GrabbingData") {
  $GrabbingData = new GrabbingData();
  echo $GrabbingData->run();
}

?>