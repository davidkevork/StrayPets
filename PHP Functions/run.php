<?php
require "includeAll.php";

if ($_GET['type'] == "GrabbingAnimals") {
  $GrabbingAnimals = new GrabbingAnimals();
  echo $GrabbingAnimals->run();
} else if ($_GET['type'] == "GrabbingData") {
  $GrabbingData = new GrabbingData();
  echo $GrabbingData->run();
} else if ($_POST['type'] == "LoginStaff") {
  $LoginStaff = new LoginStaff();
  echo $LoginStaff->run();
} else if ($_POST['type'] == "RegisterStaff") {
  $RegisterStaff = new RegisterStaff();
  echo $RegisterStaff->run();
} else if ($_POST['type'] == "NewPet") {
  $NewPet = new NewPet();
  echo $NewPet->run();
} else if ($_POST['type'] == "CreatingData") {
  $CreatingData = new CreatingData();
  echo $CreatingData->run();
}

?>