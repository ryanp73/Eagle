<?php

class Autoloader 
{
	public static function loadCore()
	{
		require_once './eagle/config.php';
		require_once './eagle/core/Router.php';
		require_once './eagle/core/View.php';
	}

	public static function loadModel($name)
	{
		$file = './eagle/models/' . $name . '.php';
		if (file_exists($file))
		{
			require_once $file;
			return true;	
		}
		return false;
	}

	public static function loadController($name)
	{
		$file = './eagle/controllers/' . $name . '.php';
		if (file_exists($file))
		{
			require_once $file;
			return true;	
		}
		return false;
	}

	public static function loadView($name)
	{
		$file = './eagle/views/' . $name . '.php';
		if (file_exists($file))
		{
			require_once $file;
			return true;	
		}
		return false;
	}
}