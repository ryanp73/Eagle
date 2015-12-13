<?php

class Router
{
	
	public $url, $controller, $action, $params = [];

	public function __construct()
	{
		if (isset($_SERVER['REQUEST_URI']))
		{
			$ru = trim($_SERVER['REQUEST_URI'], '/');
			$this->url = explode('/', $ru);
		}
		else
		{
			$this->url = [];
		}
		print_r($this->url);
		if (isset($this->url[0]) && Autoloader::loadController($this->url[0]))
		{
			$controllerName = $this->url[0] . 'Controller';
			$this->controller = new $this->controllerName;
		}
		else 
		{
			Autoloader::loadController('index');
			$this->controller = new IndexController();
		}

		if (count($this->url) >= 2)
		{
			$this->params = array_slice($this->url, 2, -1);

			if (!isset($this->url[1]))
			{
				$this->url[1] = 'get';
			}

			if (method_exists($this->controller, $this->url[1]))
			{
				$this->action = $this->url[1];
			}
		}
		var_dump($this->action);

		$this->controller->{$this->action}($this->params);
	}

	public static function get($url, $data)
	{
		
	}
}