<?php

namespace SR\Model;

use \SR\Model;
use \SR\DB\DB;

class Request extends Model
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
		$_SESSION[ Request::STATUS ] = $messageStatus;
		$_SESSION[ Request::STATUS_TYPE ] = $statusType;
	}

	public static function clearStatus()
	{
		$_SESSION[ Request::STATUS ] = false;
		$_SESSION[ Request::STATUS_TYPE ] = false;
	}

	public static function getStatus()
	{
		$status = array( 'message' => $_SESSION[ Request::STATUS ], 'type' => $_SESSION[ Request::STATUS_TYPE ]);
		Request::clearStatus();
		return $status;
	}

	private function insert()
	{
		$queryInsert = "INSERT INTO sr_request VALUES( DEFAULT, :title, :description, NOW(), :user_id, :problem_type_id)";
		$parameters = array( ':title' => $this->getTitle(), ':description' => $this->getDescription(), ':user_id' => $this->getUserId(), ':problem_type_id' => $this->getProblemTypeId());
		$this->DB->query( $queryInsert, $parameters);
	}

	private function update()
	{

	}

	public function save()
	{
		if ($this->getRequestId() == null) {
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
		return $DB->select( "
			SELECT 
				r.request_id AS request_id, r.title AS title, r.description AS description, r.request_date AS request_date, 
				u.user_id AS user_id, u.first_name AS first_name, u.last_name AS last_name, u.registration AS registration, u.email AS email, u.profile_picture AS profile_picture,
				n.note_id AS note_id, n.title AS title, n.description AS description, n.note_date AS note_date,
				a.attendance_id AS attendance_id , a.feedback AS feedback,
				sr.status_id AS status_id, sr.description AS description
			FROM sr_request AS r INNER JOIN sr_user AS u INNER JOIN sr_note AS n INNER JOIN sr_attendance AS a INNER JOIN sr_status_request AS sr
			ON r.user_id = u.user_id AND n.attendance_id = a.attendance_id AND sr.status_id = a.status_id
		");
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