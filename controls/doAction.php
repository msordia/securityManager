<?php
require '../core/init.php';

if(Input::exists()) {

	$action = Input::get('action');

	switch ($action) {
		
		case "acceptReq":

		/*
			Si la solicitud de acceso fue aceptada entonces:
			-Se genera un token de acceso y se guarda en el registro de la BD
			-Se manda un mail al usuario notificandole que su peticion fue aceptada
			-Se le comunica la informacion de ese token a la aplicacion correspondiente para que despues pueda darle acceso al usuario.
		*/

			$id = Input::get('id');
			$token = Hash::unique();
			$response = array();

			try {

				$mailer = new Mailer();
				$req = new Requests();

				$req->update(array('accessToken' => $token, 'approved' => '1', "pending" => '0'), $id);
				$req->getRequest($id);
				$data = $req->data();
				$to   = $data[0]->usermail;
				$username = $data[0]->username;

			    $mailer->sendRequestAccessAccepted($to, $username, $token);

			} catch(Exception $e) {
				$response = array( "message" => "Error:003"	);
				die($e->getMessage());
			}

			$response = array( "message" => "success");
			echo json_encode($response);

			break;

			case "rejectReq":

			$id = Input::get('id');
			$response = array();

			try {
				
				$mailer = new Mailer();
				$req = new Requests();

				$req->update(array('approved' => '0', "pending" => '0'), $id);
				$req->getRequest($id);
				$data = $req->data();
				$to   = $data[0]->usermail;
				$username = $data[0]->username;

				$to = Input::get('to');
				$mailer->sendRequestAccessDenied($to,$username);

			} catch(Exception $e) {
				$response = array( "message" => "Error:003"	);
				die($e->getMessage());
			}

			$response = array( "message" => "success");

			echo json_encode($response);
			break;

			case "getReport":

			$applicationToken = Input::get('applicationToken');
			$dateFrom = Input::get('dateFrom');
			$dateTo   = Input::get('dateTo');
			$response = array();

			$req = new Requests();
			$response = $req->getRequestReport($applicationToken, $dateFrom, $dateTo);

			echo json_encode($response);

			break;

			case "getApplicationData":

			$applications = new Applications();
			$allowed = array("token", "name");
			$response = array();
			foreach ($applications->data() as $key => $value) {
				array_push($response, array_intersect_key(objectToArray($value), array_flip($allowed)));
			}
			echo json_encode($response);

			break;

			case "deactivateApp":

			$token = Input::get('token');
			$id = Input::get('id');
			$response = array();

			try {
				$app = new Application($token);
				$app->update(array('active' => '0'), $id);
			} catch(Exception $e) {
				$response = array( "message" => "Error:003"	);
				die($e->getMessage());
			}

			$response = array( "message" => "success");
			echo json_encode($response);

			break;

			case "registerAuditor":
			$name     = Input::get('name');
			$company  = Input::get('company');
			$token = Hash::unique();
			$response = array();

			try {
				$auditors = new Auditors();
				$auditors->create(array('name' => $name, 'company' => $company, 'date'=> date('Y-m-d H:i:s'), 'accessToken' => $token ));
			} catch(Exception $e) {
				$response = array( "message" => "Error:003"	);
				die($e->getMessage());
			}

			$response = array( "message" => "success", "accessToken"=> $token);
			echo json_encode($response);

			break;

			case "getAuditReport":


			$applicationToken = Input::get('applicationToken');
			$dateFrom         = Input::get('dateFrom');
			$dateTo           = Input::get('dateTo');
			$accessToken      = Input::get('accessToken');
			$response         = array();

		/*
			Verificar que el token del auditor exista
			Posibles Mejoras: Dar un frame de tiempo para que el auditor solo pueda ver el reporte durante cierto tiempo
		*/
			$auditor = new Auditors();
			if($accessToken == "" || !$auditor->isTokenValid($accessToken)){
				$response = array( "message" => "error");
				die(json_encode($response));
			}


			$req = new Requests();
			$report = $req->getRequestReport($applicationToken, $dateFrom, $dateTo);

		/*
			Pedir un log de actividades a la aplicacion
		*/

			$app = new Application($applicationToken);
			$url = urlencode($app->data()->url);
			//$url = "http://localhost:8082/gestor/external/externalApi.php";
			$data = array('dateFrom' => $dateFrom, 'dateTo' => $dateTo);

			try {
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$log = curl_exec($ch);
				curl_close($ch);

				$response[0] = $report;
				$response[1] = $log;
				echo (json_encode($response));

			} catch(Exception $e) {
				echo("error");
				die($e->getMessage());
			}
			

			break;

					case "updateSettings":

						$username = Input::get('username');
						$mail     = Input::get('mail');
						$password = trim(Input::get('password'));
						$salt = Hash::salt(32);
						$user = new User();

						try {
							if(strlen($password) != 0 ){
								$user->update(array(
								'username'  => $username, 
								'mail'      => $mail,
								'password' 	=> Hash::make($password, $salt),
								'salt'		=> $salt,
								), $user->data()->id);
							}
							else{
								$user->update(array(
								'username'  => $username, 
								'mail'      => $mail
								), $user->data()->id);
							}

							

						} catch(Exception $e) {
							$response = array( "message" => "Error:003 ".$e->getMessage());
							die(json_encode($response));
						}

						$response = array( "message" => "success");
						echo json_encode($response);

					break;

					default:
					echo "Error: 002";
					break;

				}

			}else{
				echo "Error: 001";
			}


			function objectToArray($d) {
				if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
					$d = get_object_vars($d);
				}

				if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
	}

	?>