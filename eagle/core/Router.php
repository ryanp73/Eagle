<?php

class Router
{
	public static function handleRequests()
	{
		$routes = require_once PATH_TO_ROUTES;
		$url = $_SERVER['REQUEST_URI'];

		if (substr($url, -1) != '/') 
		{
			$url .= '/';
		}

		$matches = array();

		foreach ($routes as $path => $callback) 
		{
			if (preg_match($path, $_SERVER['REQUEST_URI'], $matches))
			{
				$callback = explode('#', $callback);
				$controller = $callback[0];
				$method = $callback[1];

				if (Autoloader::loadController($controller)) 
				{
					if (count($callback) > 2)
					{
						$matches = trim($matches[0], '/');
						$match = explode('/', $matches);

						$controller::$method($match);
					}
					else
					{
						$controller::$method();
					}
				}

				break;
			}
		}
	}
}