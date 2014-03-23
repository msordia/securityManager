<?php
require '../core/init.php';

if(Input::exists()) {

	$action = Input::get('action');

	if($action === "registerApplication"){
		
		$applicationName = Input::get('applicationName');
		$username = Input::get('username');
		$ip = "";
		$url = Input::get('url');
		$token = Hash::unique();
		
		$app = new Application();
		$created = $app->create(array(
			"name" => $applicationName,
			"registerDate" => 'now()',
			"registeredBy" => $username,
			"token" => $token,
			"url" => $url
			));

		$response = array();

		if($created){
			$response = array(
				"message" => "success",
				"applicationToken" => $token
				);
		}else{
			$response = array( "message" => "Error:003"	);
		}

		echo json_encode($response);
	}else{
		echo "Error: 002";
	}

}else{
	echo "Error: 001";
}

?>