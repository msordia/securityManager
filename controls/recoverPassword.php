<?php
require '../core/init.php';

if(Input::exists()) {	
	$validate = new Validate();
	$validation = $validate->check($_POST, array(
		'mail' => array(
			'required' => true,
			'min' => 8,
			'max' => 100)
		));

	//var_dump($validation);

	if($validation->passed()) {
		$user = new User(Input::get('mail'));
		$salt = Hash::salt(32);
		$password = substr(md5(microtime()),rand(0,26),8);

		try {

			$user->update(array(
				'password' 	=> Hash::make($password, $salt),
				'salt'		=> $salt,
				), $user->data()->id);

			echo "success";	
			echo "$password";	

		} catch(Exception $e) {
			die($e->getMessage());
		}

	}else{
		echo "error";	
	} 
}
else{
	echo "error Input not exists";	
} 
?>