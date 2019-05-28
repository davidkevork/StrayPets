<?php

function array_in_array($needle, $haystack) {
	$output = true;
	foreach ($needle as $value) {
		if (!in_array($value, $haystack)) {
			$output = false;
		}
	}
	return $output;
}

$PetState = [
	'LP',
	'Pick',
	'PCS',
	'other',
];

$data = [
	'LPV',
	'other'
];

var_dump(array_in_array($data, $PetState));

?>