<?php

class View
{
	private function __construct()
	{

	}

	public static function make($template, $data)
	{
		Autoloader::loadTemplate($template);
		
	}
}