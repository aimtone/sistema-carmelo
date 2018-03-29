<?php                          
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE"); 

	require_once "db_model.php";
	
	$db = new db_model;

	$q = file('.env');

	if(!empty($_GET['nickname'])) {
		
		$nickname = $_GET['nickname'];

		$user = $db->get(
			sprintf("%s '%s'", 
				base64_decode($q[6]), 
				$nickname
			)
		);

		if(count($user)!=0) {
			$current_url = sprintf('%s%s%s', 
				base64_decode($q[1]), 
				$nickname, 
				base64_decode($q[2])
			);

			$data = json_decode(
					file_get_contents($current_url), true
			);

			if($data['CODE'] == "200") {
				$str = "";
			 	$arr = $data['USER_DETIALS'];
			 	$counter = 1;

			 	foreach ($arr as $key => $value) {
			 		if($key!='nickname') {
						if($counter!=count($arr)) {
			 				$str = $str . $key . "=\"" . $value . "\",";
			 			} else {
			 				$str = $str . $key . "=\"" . $value . "\"";
			 			}
		 			}
		 			$counter++;
		 		}

		 		$result = $db->set(sprintf("%s %s %s = '%s'",
			 		base64_decode($q[3]),
			 		$str . base64_decode($q[5]), 
			 		base64_decode($q[4]),
					$data['USER_DETIALS']['nickname'])
				);

				if($result) {
					$array['code'] = $data['CODE'];
					$array['msg'] = $data['USER_DETIALS']['nickname'] . " : " . "Cuenta actualizada";
					$array['info'] = $data['USER_DETIALS'];
					print_json($data['CODE'], "OK", $array);
			 	} else {
			 		$array['code'] = $data['CODE'];
					$array['msg'] =  $data['USER_DETIALS']['nickname'] . " : " . "Error en el servidor";
					$array['info'] = null;
			 		print_json(200, "Error interno en el servidor", $array);
			 	}

			} else {
				if($data['CODE'] == "404"){
					$array['code'] = $data['CODE'];
					$array['msg'] =  "El usuario '" . $nickname . "' no existe";
					$array['info'] = null;
					print_json(200, "Not Found", $array);
				} else {
					$array['code'] = $data['CODE'];
					$array['msg'] = "Ha ocurrido un error interno en el servidor";
					$array['info'] = null;
					print_json(200, $data['MSG'], $array);
				}
			}

		} else {
			# if the requested user doesn't exist in the database, the script run the next script
			$current_url = sprintf('%s%s%s', 
				base64_decode($q[1]), 
				$nickname, 
				base64_decode($q[2])
			);

			$data = json_decode(
				file_get_contents($current_url), true
			);

			if($data['CODE'] == "200") {
				$keys = implode(",",array_keys($data['USER_DETIALS']));
				$values = array_values($data['USER_DETIALS']);

				foreach ($values as $key => $value) {
					$values[$key] = "\"$value\"";
				}
				$values = implode(",", $values);

				$result = $db->set(
					sprintf("%s%s%s%s%s",
						base64_decode($q[7]), 
						$keys . base64_decode($q[10]), 
						base64_decode($q[8]), 
						$values . base64_decode($q[11]), 
						base64_decode($q[9])
					)
				);


				if($result) {
					$array['code'] = $data['CODE'];
					$array['msg'] =  $data['USER_DETIALS']['nickname'] . " : " . "Cuenta registrada";
					$array['info'] = $data['USER_DETIALS'];
			 		print_json(200, "OK", $array);
				} else {
					$array['code'] = $data['CODE'];
					$array['msg'] =  $data['USER_DETIALS']['nickname'] . " : " . "Error de servidor";
					$array['info'] = $data['USER_DETIALS'];
			 		print_json(500, "Server Internal Error", $array);
				}



			} else {
				if($data['CODE'] == "404"){
					$array['code'] = $data['CODE'];
					$array['msg'] =  "El usuario '" . $nickname . "' no existe";
					$array['info'] = null;
					print_json(200, "Not Found", $array);
				} else {
					$array['code'] = $data['CODE'];
					$array['msg'] = "Ha ocurrido un error en el servidor";
					$array['info'] = null;
					print_json(200, $data['MSG'], $array);
				}
			}
		}

		
	} else {
		$clients = $db->get(
			base64_decode(
				$q[0]
			)
		);
		for ($i=0; $i < count($clients); $i++) { 

			$current_url = sprintf('%s%s%s', 
				base64_decode($q[1]), 
				$clients[$i]['nickname'], 
				base64_decode($q[2])
			);

			$data = json_decode(
				file_get_contents($current_url), true
		 	);

		 	if($data['CODE'] == "200") {
		 		$str = "";
		 		$arr = $data['USER_DETIALS'];
		 		$counter = 1;

		 		foreach ($arr as $key => $value) {
		 			if($key!='nickname') {
			 			if($counter!=count($arr)) {
			 				$str = $str . $key . "=\"" . $value . "\",";
			 			} else {
			 				$str = $str . $key . "=\"" . $value . "\"";
			 			}
		 			}
		 			$counter++;
		 		}

		 		$result = $db->set(sprintf("%s %s %s = '%s'",
		 			base64_decode($q[3]),
		 			$str . base64_decode($q[5]), 
		 			base64_decode($q[4]),
		 			$data['USER_DETIALS']['nickname'])
		 		);

		 		if($result) {
		 			$array[$i]['code'] = $data['CODE'];
		 			$array[$i]['msg'] = $data['USER_DETIALS']['nickname'] . " : " . "Cuenta actualizada";
		 			$array[$i]['info'] = $data['USER_DETIALS'];
		 			
		 		} else {
		 			$array[$i]['code'] = $data['CODE'];
		 			$array[$i]['msg'] = $data['USER_DETIALS']['nickname'] . " : " . "Error del servidor";
		 			$array[$i]['info'] = null;
		 			
		 		}

			} else {
				if($data['CODE'] == "404"){
					$array[$i]['code'] = $data['CODE'];
					$array[$i]['msg'] = "El usuario '" . $clients[$i]['nickname'] . "' no existe";
					$array[$i]['info'] = null;
					
				} else {
					$array[$i]['code'] = $data['CODE'];
					$array[$i]['msg'] = "Ha ocurrido un error en el servidor: " . $data['MSG'] . " (Error " . $data['CODE'] . ")";
					$array[$i]['info'] = null;
					
				}
				
			}
		}
		print_json(200, "OK", $array);
	}
	
	// Esta funcion imprime las respuesta en estilo JSON y establece los estatus de la cebeceras HTTP
	function print_json($status, $mensaje, $data) {
		header("HTTP/1.1 $status $mensaje");
		header("Content-Type: application/json; charset=UTF-8");
		$response['statusCode'] = $status;
		$response['statusMessage'] = $mensaje;
		$response['data'] = $data;
		echo json_encode($response, JSON_PRETTY_PRINT);
	}
?>