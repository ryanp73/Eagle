<?php

class View
{
	public static function make($template, $data)
	{
		Autoloader::loadView('partials/Header');
		Autoloader::loadView($template);
		Autoloader::loadView('partials/Footer');
	}
}
