<?php

class App
{
	private function __construct()
	{

	}

	public static function run()
	{
		require_once './eagle/core/Autoloader.php';
		Autoloader::loadCore();
		$router = new Router();
	}
}