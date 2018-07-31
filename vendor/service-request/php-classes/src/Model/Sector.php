<?php

namespace SR\Model;

use \SR\Model;
use \SR\DB\DB;

class Sector extends Model
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
		$_SESSION[ Sector::STATUS ] = $messageStatus;
		$_SESSION[ Sector::STATUS_TYPE ] = $statusType;
	}

	public static function clearStatus()
	{
		$_SESSION[ Sector::STATUS ] = false;
		$_SESSION[ Sector::STATUS_TYPE ] = false;
	}

	public static function getStatus()
	{
		$status = array( 'message' => $_SESSION[ Sector::STATUS ], 'type' => $_SESSION[ Sector::STATUS_TYPE ]);
		Sector::clearStatus();
		return $status;
	}

	private function sectorExists()
	{
		$querySelect = "SELECT sector_id, description, direction_id FROM sr_sector WHERE description = :description AND direction_id = :direction_id";
		$parameters = array( ':description' => $this->getDescription(), ':direction_id' => $this->getDirectionId());
		$response = $this->DB->select( $querySelect, $parameters);

		if ( count( $response)) {
			return true;
		} else {
			return false;
		}
	}

	private function associatedSector( $sectorId)
	{
		$querySelect = "SELECT sector_id FROM sr_user WHERE sector_id = :sector_id";
		$parameters = array( ':sector_id' => $sectorId);
		$response = $this->DB->select( $querySelect, $parameters);

		if ( count($response)) {
			return true;
		} else {
			return false;
		}
	}	

	private function insert()
	{
		if ( $this->sectorExists()) {
			throw new \Exception("Esse setor já está cadastrado!", 1);
		}

		$queryInsert = "INSERT INTO sr_sector VALUES( DEFAULT, :description, :direction_id)";
		$parameters = array( ':description' => $this->getDescription(), ':direction_id' => $this->getDirectionId());
		$this->DB->query( $queryInsert, $parameters);
	}

	private function update()
	{
		$queryUpdate = "UPDATE sr_sector SET description = :description, direction_id = :direction_id WHERE sector_id = :sector_id";
		$parameters = array( ':description' => $this->getDescription(), ':direction_id' => $this->getDirectionId(), ':sector_id' => $this->getSectorId());
		$this->DB->query( $queryUpdate, $parameters);
	}

	public function save()
	{
		if ($this->getSectorId() == false) {
			$this->insert();
		} else {
			$this->update();
		}
	}

	public function delete( $sectorId)
	{
		if ( $this->associatedSector( $sectorId)) {
			throw new \Exception("Erro! Setor já está associado à um usuário!", 1);
		}

		$queryDelete = "DELETE FROM sr_sector WHERE sector_id = :sector_id";
		$parameters = array( ':sector_id' => $sectorId);
		$this->DB->query( $queryDelete, $parameters);
	}

	public static function searchSectors( $filter)
	{
		$DB = new DB();
		$querySelect = "CALL search_sectors( :description);";
		$parameters = array( ':description' => '%' . $filter . '%');
		return $DB->select( $querySelect, $parameters);
	}	

	public static function listAll():array
	{
		$DB = new DB();
		return $response = $DB->select( "SELECT s.sector_id sector_id, s.description description, s.direction_id direction_id, d.description description_direction FROM sr_sector s INNER JOIN sr_direction d ON d.direction_id = s.direction_id");
	}

	public static function getDatasById( $sectorId):array
	{
		$DB = new DB();
		$querySelect = "SELECT s.sector_id sector_id, s.description description, s.direction_id direction_id, d.description description_direction FROM sr_sector s INNER JOIN sr_direction d ON d.direction_id = s.direction_id where s.sector_id = :sector_id";
		$parameters = array( ':sector_id' => $sectorId);
		$response = $DB->select( $querySelect, $parameters);
		return $response[0];
	}

}