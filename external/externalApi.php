<?php
require '../core/init.php';

$dateFrom         = Input::get('dateFrom');
$dateTo           = Input::get('dateTo');
$response = array();
echo "$dateFrom";

if(false){
	$response = array( "message" => "success");
} else {
	$response = array( "message" => "Error:003"	);
}

echo json_encode($response);

?>