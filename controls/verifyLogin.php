<?php
require '../core/init.php';

if(Input::exists()) {

	$user = new User();

	$remember = (Input::get('remember') === 'on') ? true : false;
	$login = $user->login(Input::get('username'), Input::get('password'), $remember);
	$response = array();

	if($login) {
		$response = array( "message" => "success", "page" => 'dashboard.php');
	} else {
		$response = array( "message" => "error");
	}

	echo json_encode($response);

}else{
	echo "error";
}

?>