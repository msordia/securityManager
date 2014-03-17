<?php
require '../core/init.php';

if(Input::exists()) {

	$nombre   = Input::get("nombre");
	$telefono = Input::get("telefono");
	$mail     = Input::get("mail");


$to = 'efrain.mendez88@gmail.com, jorgealvarez.nuova@gmail.com';
$subject = "Obtener Pro - Yolorento";
$message = "Nombre: $nombre \r\nTelefono: $telefono \r\nMail: $mail";

$headers = 'From: contacto@yolorento.com' . "\r\n".
      'Reply-To: '.$mail . "\r\n" .
      'X-Mailer: PHP/' . phpversion();
 

if(mail($to, $subject, $message, $headers)){
		echo "success";	
}else{
	echo "error";	
} 

}
?>