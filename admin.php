<?php

use \SR\PageAdmin;
use \SR\Model\User;
use \SR\Model\Sector;

$app->get( '/admin', function ()
{
	User::verifyLogin( false);

	try {

		User::canAlterPassword();
		$informations = array( 'headerTitle' => 'Admin - Inicio', 'user' => User::getSession());
		$pageAdmin = new PageAdmin( array( 'data' => $informations));
		$pageAdmin->drawPage( 'index', array( 'status' => User::getStatus()));
		
	} catch (Exception $e) {
		User::setStatus( $e->getMessage(), 'danger');
		header('Location: /service-request/admin/alter-password');
		exit();
	}

});

$app->get( '/admin/alter-password', function ()
{
	User::verifyLogin( false);

	try {

		User::canAlterPassword();
		User::setStatus( 'Erro! Você não pode acessar essa url!', 'danger');
		header('Location: /service-request/admin');
		exit();
		
	} catch (Exception $e) {
		User::setStatus( $e->getMessage(), 'danger');
		$informations = array( 'headerTitle' => 'Alterar senha', 'user' => User::getSession(),  'status' => User::getStatus());
		$pageAdmin = new PageAdmin( array( 'header' => false, 'footer' => false));
		$pageAdmin->drawPage( 'alter-password', $informations);	
	}
});

$app->post( '/admin/alter-password', function ()
{
	$user = new User();
	$user->setDatas( $_POST);

	try {
		$user->alterPassword();
		User::setStatus('Senha alterada com sucesso!', 'success');
		header("Location: /service-request/admin");
	} catch (Exception $e) {
		User::setStatus( $e->getMessage(), 'danger');
		header("Location: /service-request/admin/alter-password");
	}

	exit();
});

$app->get( '/admin/logout', function ()
{
	User::logout();
	header('Location: /service-request/login');
	exit();
});

$app->get( '/admin/profile', function ()
{
	$informations = array( 'status' => User::getStatus());
	$pageAdmin = new PageAdmin( array( 'data' => array( 'headerTitle' => 'Admin - Perfil', 'user' => User::getSession())));
	$pageAdmin->drawPage( 'profile', $informations);
});

$app->get( '/admin/profile/update', function ()
{
	$informations = array( 'headerTitle' => 'Admin - Editar Perfil', 'user' => User::getSession());
	$pageAdmin = new PageAdmin( array( 'data' => $informations));
	$pageAdmin->drawPage( 'profile-update', array( 'sectors' => Sector::listAll()));
});

$app->post( '/admin/profile/update', function ()
{
	// $user = new User();
	// $user->setDatas( $_POST);
	// $user->setProfile( $_FILES['profile_picture']);
	// $user->save();
});