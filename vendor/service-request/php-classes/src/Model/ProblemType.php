<?php

namespace SR\Model;

use \SR\Model;
use \SR\DB\DB;

class ProblemType extends Model
{
	private $DB;

	const STATUS = 'STATUS';
	const STATUS_TYPE = 'STATUS_TYPE';

	function __construct()
	{
		$this->DB = new DB();
	}

	public static function setStatus( $messageStatus, $statusType)
	{
		$_SESSION[ ProblemType::STATUS ] = $messageStatus;
		$_SESSION[ ProblemType::STATUS_TYPE ] = $statusType;
	}

	public static function clearStatus()
	{
		$_SESSION[ ProblemType::STATUS ] = false;
		$_SESSION[ ProblemType::STATUS_TYPE ] = false;
	}

	public static function getStatus()
	{
		$status = array( 'message' => $_SESSION[ ProblemType::STATUS ], 'type' => $_SESSION[ ProblemType::STATUS_TYPE ]);
		ProblemType::clearStatus();
		return $status;
	}

	private function problemExists()
	{
		$querySelect = "SELECT description FROM sr_problem_type WHERE description = :description";
		$parameters = array( ':description' => $this->getDescription());
		$response = $this->DB->select( $querySelect, $parameters);
		
		if ( count( $response)) {
			return true;
		} else {
			return false;
		}
	}

	private function associatedProblem( $problemId)
	{
		$querySelect = "SELECT problem_type_id FROM sr_request WHERE problem_type_id = :problem_type_id";
		$parameters = array( ':problem_type_id' => $problemId);
		$response = $this->DB->select( $querySelect, $parameters);

		if ( count( $response)) {
			return true;
		} else {
			return false;
		}
	}

	private function insert()
	{
		if ( $this->problemExists()) {
			throw new \Exception("Erro! Esse problema ja está cadastrado", 1);
		}

		$queryInsert = "INSERT INTO sr_problem_type VALUES( DEFAULT, :description)";
		$parameters = array( ':description' => $this->getDescription());
		$this->DB->query( $queryInsert, $parameters);
	}

	private function update()
	{
		if ( $this->problemExists()) {
			throw new \Exception("Erro! Esse problema ja está cadastrado", 1);
		}

		$queryUpdate = "UPDATE sr_problem_type SET description = :description WHERE problem_type_id = :problem_type_id";
		$parameters = array( ':description' => $this->getDescription(), ':problem_type_id' => $this->getProblemTypeId());
		$this->DB->query( $queryUpdate, $parameters);
	}

	public function save()
	{
		if ($this->getProblemTypeId() == null) {
			$this->insert();
		} else {
			$this->update();
		}
	}

	public function delete( $problemId)
	{
		if ( $this->associatedProblem( $directionId)) {
			throw new \Exception("Erro! Problema já está associado à uma solicitação!", 1);
		}

		$queryDelete = "DELETE FROM sr_problem_type WHERE problem_type_id = :problem_type_id";
		$parameters = array( ':problem_type_id' => $problemId);
		$this->DB->query( $queryDelete, $parameters);
	}

	public static function searchProblems( $filter)
	{
		$DB = new DB();
		$querySelect = "CALL search_problems( :description)";
		$parameters = array( ':description' => '%' . $filter . '%');
		return $DB->select( $querySelect, $parameters);
	}

	public static function listAll():array
	{
		$DB = new DB();
		return $DB->select( "SELECT problem_type_id, description FROM sr_problem_type");
	}

	public static function getDatasById( $problemId):array
	{
		$DB = new DB();
		$querySelect = "SELECT problem_type_id, description FROM sr_problem_type WHERE problem_type_id = :problem_type_id";
		$parameters = array( ':problem_type_id' => $problemId);
		$response = $DB->select( $querySelect, $parameters);
		return $response[0];
	}

}