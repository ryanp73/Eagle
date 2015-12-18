<?php

class View
{
	public static function make($template, $data)
	{
		Autoloader::loadView('partials/Header');
		echo $data->nickname;
		Autoloader::loadView($template);
		Autoloader::loadView('partials/Footer');
	}
}