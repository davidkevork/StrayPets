<?php
require_once (__DIR__).'/../PHP Functions/includeAll.php';

use PHPUnit\Framework\TestCase;

class NewPetTest extends TestCase
{
  protected function setUp(): void
	{
    $_POST = array();
    $_GET = array();
    $_FILES = array();
	//		'test' => array(
	//			'name' => 'poodletest.jpg',
	//			'type' => 'image/jpg',
	//			'size' => 4395,
	//			'tmp_name' => 'poodletest.jpg',
	//			'error' => 0
	//		)
	//);

    //$this->NewPet = new NewPet(true, 'poodletest.jpg');
    }
  
public function testNewPetDataWorking() : void 
	{
	  $_POST = [
		"Species" => "Dog",
		"Breed" => "Cocker-Spaniel",
		"DOB" => "2019-06-01",
		"Gender" => "male",
		"PetName" => "Rufus",
		"PetDescription" => "Pet which is fluffy"
	  ];
	  $output = $this->NewPet->validate();
	  
	  $this->assertEquals(false, $output["isError"]);
	  $this->assertEquals("Validation success", $output["message"]);
	}
public function testNewPetInvalidSpecies(): void
	{
		$_POST = [
		"Species" => "Whatever",
		"Breed" => "Cocker-Spaniel",
		"DOB" => "2019-06-01",
		"Gender" => "male",
		"PetName" => "Rufus",
		"PetDescription" => "Pet which is fluffy"
	  ];
      $output = $this->NewPet->validate();
	  
	  $this->assertEquals(false, $output["isError"]);
	  $this->assertEquals("Invalid or unknown pet species", $output["message"]);
	}
public function testNewPetInvalidBreed(): void
	{
		$_POST = [
		"Species" => "Dog",
		"Breed" => "",
		"DOB" => "2019-06-01",
		"Gender" => "male",
		"PetName" => "Rufus",
		"PetDescription" => "Pet which is fluffy"
	  ];
      $output = $this->NewPet->validate();
	  
	  $this->assertEquals(false, $output["isError"]);
	  $this->assertEquals("Invalid or unknown pet species", $output["message"]);
	}
public function testNewPetInvalidDateofBirth(): void
	{
		$_POST = [
		"Species" => "Dog",
		"Breed" => "Cocker-Spaniel",
		"DOB" => "",
		"Gender" => "male",
		"PetName" => "Rufus",
		"PetDescription" => "Pet which is fluffy"
	  ];
      $output = $this->NewPet->validate();
	  
	  $this->assertEquals(false, $output["isError"]);
	  $this->assertEquals("Invalid pet date of birth", $output["message"]);
	}
public function testNewPetInvalidPetName(): void
	{
		$_POST = [
		"Species" => "Dog",
		"Breed" => "Cocker-Spaniel",
		"DOB" => "2019-06-01",
		"Gender" => "male",
		"PetName" => "",
		"PetDescription" => "Pet which is fluffy"
	  ];
      $output = $this->NewPet->validate();
	  
	  $this->assertEquals(false, $output["isError"]);
	  $this->assertEquals("Pet Name must be between 1 and 255 characters", $output["message"]);
	}
public function testNewPetInvalidPetDescription(): void
	{
		$_POST = [
		"Species" => "Dog",
		"Breed" => "Cocker-Spaniel",
		"DOB" => "2019-06-01",
		"Gender" => "male",
		"PetName" => "Rufus",
		"PetDescription" => ""
	  ];
      $output = $this->NewPet->validate();
	  
	  $this->assertEquals(false, $output["isError"]);
	  $this->assertEquals("Pet Description must be between 1 and 255 characters", $output["message"]);
	}
}
?>