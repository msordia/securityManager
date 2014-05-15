<?php
require '../core/init.php';

if(Input::exists()) {

	$action = Input::get('action');

	switch ($action) {
		
		case "registerApplication":

		$applicationName = Input::get('applicationName');
		$username = Input::get('username');
		$ip = "";
		$url = Input::get('url');
		$token = Hash::unique();

		$app = new Application();
		$created = $app->create(array(
			"name" => $applicationName,
			"registerDate" => date('Y-m-d H:i:s'),
			"registeredBy" => $username,
			"token" => $token,
			"url" => $url
			));

		$response = array();

		if($created){
			$response = array( "message" => "success", "applicationToken" => $token	);
		}else{
			$response = array( "message" => "Error:003"	);
		}

		echo json_encode($response);
		break;

		case "requestAccess":

		$applicationToken = Input::get('applicationToken');
		$username = Input::get('username');
		$usermail = Input::get('usermail');
		$userId   = Input::get('userId');
		$duration = Input::get('duration');
		$reason   = Input::get('reason');
		$ip = "";

		//Extra: verificar que la ip de donde viene el request sea el mismo de donde esta registrada al aplicacion

		$request = new Requests();
		$created = $request->insert(array(
			"userId" => $userId ,
			"username" => $username ,
			"usermail" => $usermail ,
			"reason" => $reason ,
			"duration" => $duration ,
			"date" => date('Y-m-d H:i:s') ,
			"applicationToken" => $applicationToken
			));

		$response = array();

		if($created){
			$response = array( "message" => "success"	);
		}else{
			$response = array( "message" => "Error:003"	);
		}

		echo json_encode($response);
		break;

		break;

		default:
		echo "Error: 002";
		break;

	}

}else{
	echo "Error: 001";
}

?>