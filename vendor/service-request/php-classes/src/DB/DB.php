<?php

namespace SR\DB;

use PDO;

class DB extends PDO
{
	const HOSTNAME = "172.16.0.5";
	const USERNAME = "site";
	const PASSWORD = "ChWoaTBxTZEzVSHX";
	const DBNAME = "service_request";
	private $con;		
	
	function __construct()
	{
		$this->con = new PDO("mysql:dbname=".DB::DBNAME."; host=".DB::HOSTNAME, DB::USERNAME, DB::PASSWORD,
			array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
				PDO::ATTR_PERSISTENT => false,
				PDO::ATTR_EMULATE_PREPARES => false,
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			)
		);
	}

	private function bindParams($statement, $key, $value)
	{
		$statement->bindParam($key, $value);
	}

	private function setParams($statement, $parameters = array())
	{
		foreach ($parameters as $key => $value) {
			$this->bindParams($statement, $key, $value);
		}
	}		

	public function query( $rowQuery, $params = array('' => ''))
	{
		$stmt = $this->con->prepare($rowQuery);
		$this->setParams( $stmt, $params);
		$responseQuery = $stmt->execute();
		return $responseQuery;
	}

	public function select( $rowQuery, $params = array('' => ''))
	{
		$stmt = $this->con->prepare($rowQuery);
		$this->setParams( $stmt, $params);
		if ($stmt->execute()){ return $stmt->fetchAll(PDO::FETCH_ASSOC); } else { return 0; }
	}
}