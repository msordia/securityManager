<?php
require '../core/init.php';

if(Input::exists()) {

	$user = new User();

	$remember = (Input::get('remember') === 'on') ? true : false;
	$login = $user->login(Input::get('username'), Input::get('password'), $remember);

	if($login) {
		echo 'dashboard.php';
	} else {
		echo 'error';
	}

}else{
	echo "error";
}

?>