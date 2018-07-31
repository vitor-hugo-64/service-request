<?php

namespace SR\Model;

use \SR\Model;
use \SR\DB\DB;

class User extends Model
{
	private $DB;

	const STATUS = 'STATUS';
	const STATUS_TYPE = 'STATUS_TYPE';
	const ENCRYPTION_KEY = 'SR';
	const SESSION = 'SESSION';
	
	function __construct()
	{
		$this->DB = new DB();
	}

	public static function setStatus( $messageStatus, $statusType)
	{
		$_SESSION[ User::STATUS ] = $messageStatus;
		$_SESSION[ User::STATUS_TYPE ] = $statusType;
	}

	public static function clearStatus()
	{
		$_SESSION[ User::STATUS ] = false;
		$_SESSION[ User::STATUS_TYPE ] = false;
	}

	public static function getStatus()
	{
		$status = array( 'message' => $_SESSION[ User::STATUS ], 'type' => $_SESSION[ User::STATUS_TYPE ]);
		User::clearStatus();
		return $status;
	}

	public function userExists()
	{
		$querySelect = "SELECT user_id FROM sr_user WHERE email = :email OR registration = :registration";
		$parameters = array( ':email' => $this->getEmail(), ':registration' => $this->getRegistration());
		$response = $this->DB->select( $querySelect, $parameters);

		if ( count($response)) {
			return true;
		} else {
			return false;
		}
	}

	private function insert()
	{
		if ( $this->userExists()) {
			throw new \Exception("Erro! Email ou mátrícula já vinculada a outro usuário", 1);
		}

		if ( $this->getIsAdministrator() == null) {
			$this->setIsAdministrator( 'n');
		}

		if ( $this->getAlterPassword() == null) {
			$this->setAlterPassword( 'n');
		}

		$queryInsert = "INSERT INTO sr_user VALUES( DEFAULT, :first_name, :last_name, :registration, :email, :password, DEFAULT, DEFAULT, :is_administrator, :alter_password, :sector_id)";
		$parameters = array( 
			':first_name' => $this->getFirstName(), 
			':last_name' => $this->getLastName(), 
			':registration' => $this->getRegistration(), 
			':email' => $this->getEmail(), 
			':password' => crypt( $this->getPassword(), User::ENCRYPTION_KEY), 
			':is_administrator' => $this->getIsAdministrator(), 
			':alter_password' => $this->getAlterPassword(), 
			':sector_id' => $this->getSectorId()
		);

		echo json_encode( $this->getDatas());

		$this->DB->query( $queryInsert, $parameters);
	}

	public static function alterProfilePicture( $file)
	{
		if( isset( $file)){

  			date_default_timezone_set("Brazil/East");

  			$extension = explode( '.', $file['name']);
  			$extension = '.' . end( $extension);
  			$newName = date( "Y.m.d-H.i.s") . $extension;

  			$directory =  DIRECTORY_SEPARATOR . 'service-request/res/img/profiles/';

  			move_uploaded_file( $file['tmp_name'], $directory.$newName);

  			return $directory.$newName;
  		}
  	}

  	private function update()
  	{

  		$directoryPicture = User::alterProfilePicture( $this->getProfilePicture());
  		echo json_encode( $directoryPicture);
  		// $this->setProfilePicture( $directoryPicture);
  		// echo $this->getProfilePicture();
  		// $queryUpdate = "UPDATE sr_user SET first_name = :first_name, last_name = :last_name, registration = :registration, sector_id = :sector_id, email = :email, profile_picture = :profile_picture";
  		// $parameters = array( ':first_name' => $this->getFirstName, ':last_name' => $this->getLastName(), ':registration' => $this->getRegistration(), ':sector_id' => $this->getSectorId(), ':email' => $this->getEmail(), ':profile_picture' => $this->getProfilePicture());
  		// $this->DB->query( $queryUpdate, $parameters);
  	}

  	public function save()
  	{
  		if ( $this->getUserId() == false) {
  			$this->insert();
  		} else {
  			$this->update();
  		}
  	}

  	public static function canAlterPassword()
  	{
		if ( $_SESSION[ User::SESSION ]['alter_password'] == 's') {
			throw new \Exception("É necessário trocar sua senha", 1);
		}
  	}

  	public function alterPassword()
  	{
  		if ( $this->getAlterPassword() == null) {
  			$this->setAlterPassword( 'n');
  		}

  		if ( $this->getPassword() != $this->getRepeatPassword()) {
  			throw new \Exception("Erro! As duas senhas informadas não são iguais!", 1);
  		}

  		$queryUpdate = "UPDATE sr_user SET password = :password, alter_password = :alter_password WHERE user_id = :user_id";
  		$parameters = array( ':password' => crypt( $this->getPassword(), User::ENCRYPTION_KEY), ':alter_password' => $this->getAlterPassword(), ':user_id' => $this->getUserId());
  		$this->DB->query( $queryUpdate, $parameters);
  		$_SESSION[ User::SESSION ]['alter_password'] = 'n';
  	}

  	public static function disableEnableUser( $userId)
  	{
  		$user = User::getDatasById( $userId);

  		if ( $user['is_active'] == 's') {
  			$choice = 'n';
  		} else {
  			$choice = 's';
  		}

  		if ( $user['is_administrator'] == 'n') {
  			$DB = new DB();
  			$queryUpdate = "UPDATE sr_user SET is_active = :choice WHERE user_id = :user_id";
  			$parameters = array( ':choice' => $choice, ':user_id' => $userId);
  			$DB->query( $queryUpdate, $parameters);
  		} else {
  			throw new \Exception("Erro! Esse usuário tem permissões de administrador", 1);		
  		}

  		return $choice;
  	}

  	public static function searchUsers( $filter)
  	{
  		$DB = new DB();
  		$querySelect = "CALL search_users( :description);";
  		$parameters = array( ':description' => '%' . $filter . '%');
  		return $DB->select( $querySelect, $parameters);
  	}		

  	public static function listAll():array
  	{
  		$DB = new DB();
  		return $DB->select( "SELECT u.user_id, u.first_name, u.last_name, u.registration, u.email, u.password, u.profile_picture, u.is_active, u.is_administrator, u.alter_password, u.sector_id, s.description FROM sr_user u INNER JOIN sr_sector s ON u.sector_id = s.sector_id");
  	}

  	public static function getDatasById( $userId):array
  	{	
  		$DB = new DB();
  		$querySelect = "SELECT u.user_id, u.first_name, u.last_name, u.registration, u.email, u.password, u.profile_picture, u.is_active, u.is_administrator, u.alter_password, u.sector_id, s.description FROM sr_user u INNER JOIN sr_sector s ON u.sector_id = s.sector_id WHERE user_id = :user_id";
  		$parameters = array( ':user_id' => $userId);
  		$response = $DB->select( $querySelect, $parameters);
  		return $response[0];
  	}

  	public static function login( $datas)
  	{
  		$DB = new DB();

  		if ( strstr( $datas['login'], '@')) {
  			$querySelect = "SELECT user_id, first_name, last_name, registration, email, password, profile_picture, is_active, is_administrator, alter_password, sector_id FROM sr_user WHERE email = :filter";
  		} else {
  			$querySelect = "SELECT user_id, first_name, last_name, registration, email, password, profile_picture, is_active, is_administrator, alter_password, sector_id FROM sr_user WHERE registration = :filter";
  		}

  		$parameters = array( ':filter' => $datas['login']);
  		$response = $DB->select( $querySelect, $parameters);

  		if ( !count( $response)) {
  			throw new \Exception("Login ou senha inválido", 1);
  		}

  		$user = $response[0];

  		if ( $user['is_active'] == 'n') {
  			throw new \Exception("Erro! Usuário desativado!", 1);

  		}

  		if ( !password_verify( $datas['password'], $user['password'])) {
  			throw new \Exception("Login ou senha inválido", 1);	
  		}

  		$_SESSION[ User::SESSION ] = $user;
  	}

  	public static function logout()
  	{
  		$_SESSION[ User::SESSION ] = null;
  	}

  	public static function checkLogin()
  	{

  		if ( !isset( $_SESSION[ User::SESSION ]) || !$_SESSION[ User::SESSION ] || !(int)$_SESSION[ User::SESSION ]['user_id'] > 0) {
  			return false;
  		} else {
  			return true;
  		}

  	}

  	public static function canAccess( $isAdministrator)
  	{
  		if ( $isAdministrator === true && $_SESSION[ User::SESSION ]['is_administrator'] == 'n') {

  			return false;

  		} else {
  			return true;
  		}
  	}

  	public static function verifyLogin( $isAdministrator)
  	{
  		if ( User::checkLogin()) {

  			if ( !User::canAccess( $isAdministrator)) {

  				User::setStatus( 'Erro! Seu usuário não tem permissões para acessar essa página!', 'danger');
  				header('Location: /service-request/admin');

  			} else {
  				return true;
  			}

  		} else {

  			User::setStatus( 'Erro! Efetue login!', 'danger');
  			header('Location: /service-request/login');
  		}

  		exit();
  	}

  	public static function getSession()
  	{
  		return $_SESSION[ User::SESSION ];
  	}
  	
  }