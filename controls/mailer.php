<?php

require '../core/init.php';

if(Input::exists()) {

	$to = Input::get('to');
	$subject = Input::get('subject');
	$message = Input::get('message');
	
}

?>