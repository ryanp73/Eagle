<?php

class Autoloader
{
	private function __construct()
	{
	}

	/**
	 *    Load all of the necessary files
	 *    @return void
	 */
	public static function loadCore()
	{
		require_once './eagle/config/config.php';
		require_once './eagle/core/Router.php';
	}

	public static function loadController($name)
	{
		$name[0] = strtoupper($name[0]);
		$file = './eagle/controllers/' . $name . 'Controller.php';
		if (file_exists($file))
		{
			require_once $file;
			return true;	
		}
		return false;
	}

	public static function loadTemplate($name)
	{
		$name[0] = strtoupper($name[0]);
		$file = './eagle/views/' . $name . 'Template.php';
		if (file_exists($file))
		{
			require_once $file;
			return true;	
		}
		return false;
	}
}