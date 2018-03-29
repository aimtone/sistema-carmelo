#!/usr/bin/php
<?php                          
	require_once "db_model.php";
	
	$db = new db_model;

	$q = file('.env');

	echo "\nMagic Web Data Updater - V.1.0.0\n"; 
	if(!empty($argv[1])) {

		$nickname = $argv[1];

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
			 		echo "\n" . $data['USER_DETIALS']['nickname'] . " : " . "Account update";
			 	} else {
			 		echo "\n" . $data['USER_DETIALS']['nickname'] . " : " . "Server error";
			 	}

			} else {
				if($data['CODE'] == "404"){
					echo "\nUser \"" . $nickname . "\" doesn't exist";
				} else {
					echo "\nIt happened an error on server: " . $data['MSG'] . " (Error " . $data['CODE'] . ")";
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
					echo "\n" . $data['USER_DETIALS']['nickname'] . " : " . "Account registered";
				} else {
					echo "\n" . $data['USER_DETIALS']['nickname'] . " : " . "Server error";
					
				}

			} else {
				if($data['CODE'] == "404"){
					echo "\nUser \"" . $nickname . "\" doesn't exist";
				} else {
					echo "\nIt happened an error on server: " . $data['MSG'] . " (Error " . $data['CODE'] . ")";
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
		 			echo "\n" . $data['USER_DETIALS']['nickname'] . " : " . "Account update";
		 		} else {
		 			echo "\n" . $data['USER_DETIALS']['nickname'] . " : " . "Server error";
		 		}

			} else {
				if($data['CODE'] == "404"){
					echo "\nUser \"" . $clients[$i]['nickname'] . "\" doesn't exist";
				} else {
					echo "\nIt happened an error on server: " . $data['MSG'] . " (Error " . $data['CODE'] . ")";
				}
				
			}
		}
	}

	

	echo "\n";
?>