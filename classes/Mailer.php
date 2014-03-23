<?php
class Mailer {
	private $_db;

	public function __construct($token = null) {
		$this->_db = DB::getInstance();
	}

	public function send ($to, $subject, $message) {
		
		$headers = 'From: no-reply@securityManager.com' . "\r\n".
		'Reply-To: '.$_POST['EMAIL'] . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

		if( mail($to, $subject, $message, $headers) ){
			echo "success";
		}else{
			echo "Error: 101";
		} 
	}

}