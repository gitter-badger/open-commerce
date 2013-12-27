<?php
class Database {
	private $db;
	
	public $debug;
	
	public $db_host;
	public $db_name;
	public $db_user;
	public $db_pass;
	
	public function Connect()
	{
		try {
			$this->db = new PDO("mysql:host=".$this->db_host.";dbname=".$this->db_name, $this->db_user, $this->db_pass);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e){
			($this->debug)?die($e):die();
			file_put_contents('PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		}
	}
	
	public function isConnected()
	{
		if ($this->db)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function updateQuery($sql,$params)
	{
		try {
			$q = $this->db->prepare($sql);
			$q->execute($params);
			if(!$q)
			{
				throw new SQLException("Error Processing Request", 1);
			}
			else
			{
				return $q;
			}
		} catch(SQLException $e){
			return $e->getMessage();
		}
	}
	
	public function selectQuery($sql,$params)
	{
		try {
			$q = $this->db->prepare($sql);
			$q->execute($params);
			$num = $q->rowCount();
			if(!$q)
			{
				throw new SQLException("Error Processing Request", 1);
			}
			else
			{
				for($i=1;$i<$num;$i++){
					$q->bindColumn($i,$params);
				}
			}
		} catch(SQLException $e){
			return $e->getMessage();
		}
	}
}
?>