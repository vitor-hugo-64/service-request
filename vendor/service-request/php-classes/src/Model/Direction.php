<?php

namespace SR\Model;

use \SR\Model;
use \SR\DB\DB;

class Direction extends Model
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
		$_SESSION[ Direction::STATUS ] = $messageStatus;
		$_SESSION[ Direction::STATUS_TYPE ] = $statusType;
	}

	public static function clearStatus()
	{
		$_SESSION[ Direction::STATUS ] = false;
		$_SESSION[ Direction::STATUS_TYPE ] = false;
	}

	public static function getStatus()
	{
		$status = array( 'message' => $_SESSION[ Direction::STATUS ], 'type' => $_SESSION[ Direction::STATUS_TYPE ]);
		Direction::clearStatus();
		return $status;
	}

	private function directionExists()
	{
		$querySelect = "SELECT direction_id, description, initials FROM sr_direction WHERE description = :description AND initials = :initials";
		$parameters = array( ':description' => $this->getDescription, ':initials' => $this->getInitials());
		$response = $this->DB->select( $querySelect, $parameters);
		
		if ( count( $response)) {
			return true;
		} else {
			return false;
		}
	}

	private function associatedDirection( $directionId)
	{
		$querySelect = "SELECT direction_id FROM sr_sector WHERE direction_id = :direction_id";
		$parameters = array( ':direction_id' => $directionId);
		$response = $this->DB->select( $querySelect, $parameters);

		if ( count( $response)) {
			return true;
		} else {
			return false;
		}
	}

	private function insert()
	{
		if ( $this->directionExists()) {
			throw new \Exception("Erro! Essa direção ja está cadastrada", 1);
		}

		$queryInsert = "INSERT INTO sr_direction VALUES( DEFAULT, :description, :initials)";
		$parameters = array( ':description' => $this->getDescription(), ':initials' => $this->getInitials());
		$this->DB->query( $queryInsert, $parameters);
	}

	private function update()
	{
		$queryUpdate = "UPDATE sr_direction SET description = :description, initials = :initials WHERE direction_id = :direction_id";
		$parameters = array( ':description' => $this->getDescription(), ':initials' => $this->getInitials(), ':direction_id' => $this->getDirectionId());
		$this->DB->query( $queryUpdate, $parameters);
	}

	public function save()
	{
		if ($this->getDirectionId() == null) {
			$this->insert();
		} else {
			$this->update();
		}
	}

	public function delete( $directionId)
	{
		if ( $this->associatedDirection( $directionId)) {
			throw new \Exception("Erro! Direção já está associada à um setor!", 1);
		}

		$queryDelete = "DELETE FROM sr_direction WHERE direction_id = :direction_id";
		$parameters = array( ':direction_id' => $directionId);
		$this->DB->query( $queryDelete, $parameters);
	}

	public static function searchDirections( $filter)
	{
		$DB = new DB();
		$querySelect = "CALL search_directions( :description)";
		$parameters = array( ':description' => '%' . $filter . '%');
		return $DB->select( $querySelect, $parameters);
	}

	public static function listAll():array
	{
		$DB = new DB();
		return $DB->select( "SELECT direction_id, description, initials FROM sr_direction");
	}

	public static function getDatasById( $directionId):array
	{
		$DB = new DB();
		$querySelect = "SELECT direction_id, description, initials FROM sr_direction WHERE direction_id = :direction_id";
		$parameters = array( ':direction_id' => $directionId);
		$response = $DB->select( $querySelect, $parameters);
		return $response[0];
	}

}