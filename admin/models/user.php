<?php

use LDAP\Result;

class User
{
	public static function mdlListar($code_prod)
	{
		#obtener token

		$urltoken = "https://develop.datacrm.la/anieto/anietopruebatecnica/webservice.php?operation=getchallenge&username=prueba";
		$result = file_get_contents($urltoken);
		$resultArray = json_decode($result, true);
		$token = $resultArray['result']['token'];

		#obtener accessKey

		$accessKey = md5($token . '3DlKwKDMqPsiiK0B');

		#obtener sessionName

		$fields = ['operation' => 'login', 'username' => 'prueba', 'accessKey' => $accessKey];
		$fields_string = http_build_query($fields);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, "https://develop.datacrm.la/anieto/anietopruebatecnica/webservice.php");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		$data = curl_exec($ch);
		curl_close($ch);
		$dataArray = json_decode($data, true);

		$sessionName =  $dataArray['result']['sessionName'];

		#obtener json

		try {
			$getUrl = "https://develop.datacrm.la/anieto/anietopruebatecnica/webservice.php?operation=query&sessionName=" . $sessionName . "&query=select * from Contacts;";
			$getUrl = str_replace(' ', '%20', $getUrl);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $getUrl);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$response = curl_exec($ch);
			curl_close($ch);
			$datosjson['data'] = json_decode($response, true);
		} catch (\Throwable $th) {
			$datosjson['error'] = true;
			$datosjson['data'] = 'Error al obtener json';
		}
			return $datosjson;
	}
}
