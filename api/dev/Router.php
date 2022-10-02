<?php
//_____________Router Class_____________\\
/**
 * @method addRoute
 * @method getRoute 
 */
class Router{
	private static $routes = array();

	/**
	 * @param $path | string 
	 * @param $method | string
	 * @param $action | object
	 * @param $secure | boolean
	 * @return null
	 */
	public static function addRoute($path, $method, $action, $secure = true)
	{	
		//Get aplication root from config object\\
		$path = Config::$data->app_root.$path;
		
		//format url and asign as a key in routes array along with method\\
		$url = self::url_decode($path);
		self::$routes[$url][$method] = ['action'=>$action, 'secure'=>$secure, 'path'=>$path];
	}

	/**
	 * @return object method result.
	 */
	public static function getRoute()
	{
		//Asign variables\\
		$uri = $_SERVER['REQUEST_URI'];
		$url = self::url_decode($uri);
		$method = $_SERVER['REQUEST_METHOD'];

		//Is a valid route?\\
		if(self::is_route_invalid($url, $method))
			return self::is_route_invalid($url, $method);

		//Asign route varibles\\
		$route = self::$routes[$url][$method];
		$action = explode("@", $route['action']);
		$secure_route = $route['secure'];
		$path = $route['path'];

		//Is authorized to continue?\\
		if($secure_route)
			if(Authorization::has_rights());
			else {
				header('HTTP/1.1 401 Unauthorized');  
				return ['status_code'=>401, "message"=>'Unauthorized'];
			}
		

		//Asign passed values trough request(json, url, etc)\\
		$vars = self::url_var_extract($url, $path);
		$json = file_get_contents("php://input");
		$json_array = json_decode($json, true);
		if($json_array != null)
			$vars = array_merge($vars, json_decode($json, true));
		$vars = array_merge($vars, $_POST, $_GET);

		//Get object name and import it.\\
		$obj = $action[0];
		include("./src/controller/" . $obj . ".php");

		//Create object and return the response\\
		$obj = new $obj();
		$obj_method = $action[1];

		return $obj->$obj_method($vars);

	}

	/**
	 * gets an string of url and replace any number with "."
	 * ex: /user/123 => /user/.
	 * @param string
	 * @return string
	 */
	private static function url_decode($url)
	{	
		//Create array from url and remove extra parameters\\
		$url = explode("?", $url)[0];
		$url = explode("/", $url);

		//replace any number with .
		for($i = 0; $i < count($url); $i++)
		{
			if($url[$i] != '')
			{
				if($url[$i][0] == '{' && $url[$i][-1] == '}')
					$url[$i] = '.';
				
				if(is_numeric($url[$i]))
					$url[$i] = '.';
			}
		}

		//Make url back a string and return it\\
		$url = implode("/",$url);
		return $url;
	} 

	/**
	 * Gets an formated url and a path example and create an array with values
	 * ex: real url: /user/12 | parameters: /user/. , /user/{id} | result: ["id"=> 12]
	 * @param $url
	 * @param $path
	 * @return array
	 */
	private static function url_var_extract($url, $path)
	{
		//Make url,path,uri arrays and remove extra parameters\\
		$path = explode("?", $path)[0];
		$path = explode("/", $path);

		$url = explode("/", $url);

		$uri = explode("?", $_SERVER['REQUEST_URI'])[0];
		$uri = explode("/", $uri);
	
		//Create a string with all keys and values\\
		$vars =  "";
		for($i = 0; $i < count($url); $i++)
		{
			if($url[$i] == '.'){
				$vars .= substr($path[$i], 1, -1) . "=" . $uri[$i] . "&";
			}
		}

		//remove last & caracter and create an array from string
		$vars = substr($vars, 0, -1);
		parse_str($vars, $vars);
		return $vars;
	}

	/**
	 * Get's formated url string and a method. Returns true is a route exist with these keys.
	 * @param string
	 * @param string
	 * @return bool
	 */
	private static function is_route_invalid($url, $method){
		//exists Route with url and method keys?\\
		if(empty(self::$routes[$url][$method])){
			header('HTTP/1.1 404 Not Found');  
			return ['status_code'=>404, 'message'=>'Not Found!'];
		}

		//Return false if exists\\
		return false;
	}
}