<?php

/*
Octopus - Security Manager
Copyright (C) 2014 - ITESM

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program.  If not, see <http://www.gnu.org/licenses/>.


Authors:
	
- ITESM representatives
   Ing. Martha Sordia Salinas <msordia@itesm.mx>
   Dr. Juan Arturo Nolazco Flores <jnolazco@itesm.mx>
   Ing. Maria Isabel Cabrera Cancino <marisa.cabrera@tecvirtual.mx>


- ITESM students
	Jose Leal 
	Alejandro Cristerna
	Raul Vanoye
*/

/*
	Estamos usando la libreria de PHPMailer para enviar los correos.
	Pueden encontrar ejemplos y documentacion en la siguiente liga: (https://github.com/PHPMailer/PHPMailer)
*/

require 'PHPMailer/PHPMailerAutoload.php';

class Mailer {
	private $_db;
	private $systemMail;
	private $systemName;

	public function __construct($token = null) {
		$this->_db = DB::getInstance();
		$this->systemMail = 'noreply@octopusSecurityManager.com';
	    $this->systemName = 'Octoupus Security Manager';
	}

	/*Enviar un mail generico*/
	public function send ($to, $subject, $message) {
		$to = 'luis.chapa01@gmail.com';
		//Create a new PHPMailer instance
		$mail = new PHPMailer();
		//Set who the message is to be sent from
		$mail->setFrom($this->systemMail, $this->systemName);
		//Set an alternative reply-to address
		$mail->addReplyTo($this->systemMail, $this->systemName);
		//Set who the message is to be sent to
		$mail->addAddress($to, '');
		//Set the subject line
		$mail->Subject = $subject;
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->msgHTML($message, dirname(__FILE__));
		//Replace the plain text body with one created manually
		$mail->AltBody = $message;

		//send the message, check for errors
		if (!$mail->send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
	}


	/*Enviar un mail de rechazo a solicitud de acceso*/
	public function sendRequestAccessDenied ($to, $username) {
		
		$subject = "Security Manager - Access request denied";
		$message = file_get_contents('../includes/templates/mails/accessDenied.html');
		$message = str_replace('$username', $username, $message);

		$this->send($to, $subject, $message);
	}

	/*Enviar un mail de aceptacion solicitud de acceso*/
	public function sendRequestAccessAccepted ($to, $username, $token) {
		
		$subject = 'Security Manager - Access request accepted'; 
		$message = file_get_contents('../includes/templates/mails/accessAccepted.html');
		$message = str_replace(array('$username', '$token'), array($username, $token), $message);

		$this->send($to, $subject, $message);
	}

}