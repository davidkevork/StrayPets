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
  
 // public function testCreatingDataNotWorking() : void 
 // {
//	  $_POST = [
//		"Species" => "Dog",
//		"Breed" => "Cocker-Spaniel",
	//	"DOB" => "2019-06-01",
//		"Gender" => "male",
//		"PetName" => "Rufus",
//		"
 // }
//}
}
?>