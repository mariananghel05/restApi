<?php
session_start();
session_regenerate_id();
//_____________Authorization Class_____________\\
	/**
 * @method respond
 * @method genToken
 * @method validateToken
 * @method getPayload
 * @method getHeader
 * 
 */
class Authorization{
		/**
	 * @param $payload | string(json format) / array
	 * @param $password | string
	 * @return string
	 */
	public static function genToken($payload, $password){
		$header = '{"alg":"sha256","typ":"JWT"}';

		//Is payload and header a string or an array? Parse as json if array\\
		if(gettype($header) == 'array' && gettype($payload) == 'array'){
			$header = json_encode($header);
			$payload = json_encode($payload);
		}

		//remove any spaces could result from a passed string\\
		$header = str_replace(' ', '', $header);
		$payload = str_replace(' ', '', $payload);

		//encode in base64 the header and payload\\
		$header = str_replace(["+", "/", "="],["-", "_", ""], base64_encode($header));	
		$payload = str_replace(["+", "/", "="],["-", "_", ""], base64_encode($payload));

		//Hash the header and payload with a password to create a signature\\
		$signature = hash_hmac('sha256', $header . "." . $payload, $password.random_bytes(64), true);
		$signature = str_replace(["+", "/", "="], ["-", "_", ""], base64_encode($signature));

		//add based64 header, payload and signature as one string separeted each one with "." \\
		$token = $header . "." . $payload . "." . $signature;
		
		//Save into session and return it\\
		$_SESSION['token'] = $token;
		$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		$_SESSION['agent'] = $_SERVER['HTTP_USER_AGENT'];
		return $token;
	}

		/**
	 * @param $token | string 
	 */
	public static function validateToken($token){
		if(!isset($_SESSION['token']))
			return false;
		if($token == $_SESSION['token'] && $_SERVER['REMOTE_ADDR'] == $_SESSION['ip'] && $_SESSION['agent'] == $_SERVER['HTTP_USER_AGENT']){
			return true;
		}
		return false;
	}

		/**
	 * Give a token and returns the payload of it.
	 * @param $token | string 
	 * @return string
	 */
	public static function getPayload($token){
		$token = explode(".", $token);
		$payload = json_decode(base64_decode(str_replace(["-", "_"], ["+", "/"], $token[1])), true);
		return $payload;
	}

		/**
	 * Give a token and returns the header of it.
	 * @param $token | string
	 * @return string 
	 */
	public static function getHeader($token){
		$token = explode(".", $token);
		$header = json_decode(base64_decode(str_replace(["-", "_"], ["+", "/"], $token[0])), true);
		return $header;
	}

		/**
	 * Give a token and returns the signature of it.
	 * @param $token | string
	 * @return string 
	 */
	//Broken\\
	public static function getSignature($token){
		$token = explode(".", $token);
		$signature = json_decode(base64_decode(str_replace(["-", "_"], ["+", "/"], $token[2])), true);
		return $signature;
	}

}
