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
		$password = substr(md5(microtime()),rand(0,26),8);  //un string random de 8 caracteres

		try {
			$mailer = new Mailer();

			$user->update(array(
				'password' 	=> Hash::make($password, $salt),
				'salt'		=> $salt,
				), $user->data()->id);

			echo "success";	


			$to = Input::get('to');
			$subject = "Security Manager - Password recovery";
			$message = "Your new password is: $password \n\n Please don't reply to this message.";
			$mailer->send($to, $subject, $message);

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