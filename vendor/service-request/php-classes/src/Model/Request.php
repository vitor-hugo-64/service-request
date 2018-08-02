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
		$queryInsert = "INSERT INTO sr_request VALUES( DEFAULT, :title, :description, NOW(), DEFAULT, :user_id, :problem_type_id)";
		$parameters = array( ':title' => $this->getTitle(), ':description' => $this->getDescription(), ':user_id' => $this->getUserId(), ':problem_type_id' => $this->getProblemTypeId());
		$this->DB->query( $queryInsert, $parameters);
	}

	private function update()
	{
		$queryUpdate = "UPDATE sr_request SET title = :title, description = :description, problem_type_id = :problem_type_id WHERE request_id = :request_id";
		$parameters = array( ':title' => $this->getTitle(), ':description' => $this->getDescription(), ':problem_type_id' => $this->getProblemTypeId(), ':request_id' => $this->getRequestId());
		$this->DB->query( $queryUpdate, $parameters);
	}

	public function save()
	{
		if ($this->getRequestId() == null) {
			$this->insert();
		} else {
			$this->update();
		}
	}

	public static function cancel( $requestId)
	{
		$DB = new DB();
		$queryUpdate = "UPDATE sr_request SET status_id = 4 WHERE request_id = :request_id";
		$parameters = array( ':request_id' => $requestId);
		$DB->query( $queryUpdate, $parameters);
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
		return $DB->select("SELECT
			r.request_id, r.title, r.description request_description, r.request_date, r.status_request,
			a.attendance_id, a.feedback, a.user_id, a.in_progress, count( a.user_id) number_attendances,
			u.user_id, u.first_name, u.last_name, u.registration, u.email, u.profile_picture,
			s.sector_id, s.description sector_description,
			p.problem_type_id, p.description problem_type_description
			FROM sr_request r LEFT JOIN sr_attendance a ON r.request_id = a.request_id
			JOIN sr_user u ON u.user_id = r.user_id
			JOIN sr_sector s ON u.sector_id = s.sector_id
			JOIN sr_problem_type p ON p.problem_type_id = r.problem_type_id
			GROUP BY r.request_id
			");
	}

	public static function getDatasById( $requestId):array
	{
		$DB = new DB();
		$querySelect = "SELECT
		r.request_id, r.title, r.description request_description, r.request_date, r.status_request,
		a.attendance_id, a.feedback, a.user_id, a.in_progress, count( a.user_id) number_attendances,
		u.user_id, u.first_name, u.last_name, u.registration, u.email, u.profile_picture,
		s.sector_id, s.description sector_description,
		p.problem_type_id, p.description problem_type_description
		FROM sr_request r LEFT JOIN sr_attendance a ON r.request_id = a.request_id
		JOIN sr_user u ON u.user_id = r.user_id
		JOIN sr_sector s ON u.sector_id = s.sector_id
		JOIN sr_problem_type p ON p.problem_type_id = r.problem_type_id
		GROUP BY r.request_id
		WHERE r.request_id = :request_id";
		$parameters = array( ':request_id' => $requestId);
		$response = $DB->select( $querySelect, $parameters);
		return $response[0];
	}

	public static function meet( $requestId, $userId)
	{
		$DB = new DB();
		$parameters = array( ':feedback' => null, ':user_id' => $userId, ':request_id' => $requestId);
		$queryInsert = "INSERT INTO sr_attendance VALUES( DEFAULT, :feedback, :user_id, :request_id, DEFAULT)";
		$DB->query( $queryInsert, $parameters);
		$parameters = array( ':request_id' => $requestId);
		$queryUpdate = "UPDATE sr_request SET status_request = 'Em atendimento' WHERE request_id = :request_id";
		$DB->query( $queryUpdate, $parameters);
	}

	public static function stopMeet( $requestId, $userId)
	{
		$DB = new DB();
		$parameters = array( ':user_id' => $userId, ':request_id' => $requestId, ':change' => 'n');
		$queryInsert = "UPDATE sr_attendance SET in_progress = :change WHERE user_id = :user_id AND request_id = :request_id";
		$DB->query( $queryInsert, $parameters);
		$parameters = array( ':request_id' => $requestId);
		$queryUpdate = "UPDATE sr_request SET status_request = 'Em aberto' WHERE request_id = :request_id";
		$DB->query( $queryUpdate, $parameters);
	}

}