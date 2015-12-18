<?php

class App
{
	public function __construct()
	{
		require_once './eagle/core/Autoloader.php';
		Autoloader::loadCore();
		Router::handleRequests();
	}
}