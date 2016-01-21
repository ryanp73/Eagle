<?php

class DB 
{
	public $db;

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

	public function getById($table, $fieldName, $id, $modelName)
	{
		$sth = $this->db->prepare("SELECT * FROM $table WHERE $fieldName == :id");
		if ($sth->execute(array(":id" => $id)))
		{
			$sth->setFetchMode(PDO::FETCH_CLASS, $modelName);
			return $sth->fetch();
		}
		return false;
	}

	public function getAll($table, $fieldName, $id, $modelName)
	{
		$sth = $this->db->prepare("SELECT * FROM $table");
		if ($sth->execute())
		{
			$sth->setFetchMode(PDO::FETCH_CLASS, $modelName);
			return $sth->fetchAll();
		}
		return false;
	}

	public function insertIntoTable($table, array $fields, array $values)
	{
		$sql = "INSERT INTO $table (" . implode(", ", $fields) . ") VALUES ("; 
		$sql .= str_repeat("?, ", count($values) - 1) . "?)";
		$sth = $this->db->prepare($sql);
		return $sth->execute($values);
	}
}