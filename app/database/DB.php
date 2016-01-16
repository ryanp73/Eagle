<?php

class DB 
{
	public function __construct($location)
	{
		try 
		{
			$this->db = new PDO("sqlite:" . $location);			
		}
		catch (PDOException $e) 
		{
			echo $e->getMessage();
		}
	}
}