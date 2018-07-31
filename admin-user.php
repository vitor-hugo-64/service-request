<?php

use \SR\PageAdmin;
use \SR\Model\User;
use \SR\Model\Sector;

$app->get( '/admin/user', function ()
{
	User::verifyLogin( true);
	$pageAdmin = new PageAdmin( array( 'data' => array( 'headerTitle' => 'Admin - Usuário', 'user' => $_SESSION[ User::SESSION ])));
	$pageAdmin->drawPage( 'user', array( 'status' => User::getStatus(), 'users' => User::listAll()));
});

$app->get( '/admin/user/insert', function ()
{
	$pageAdmin = new PageAdmin( array( 'data' => array( 'headerTitle' => 'Admin - Cadastrar Usuário', 'user' => $_SESSION[ User::SESSION ])));
	$pageAdmin->drawPage( 'user-insert', array( 'sectors' => Sector::listAll()));
});

$app->post( '/admin/user/insert', function ()
{
	$user = new User();
	$user->setDatas( $_POST);

	try {
		$user->save();
		User::setStatus( 'Usuário adicionado com sucesso!', 'success');
	} catch (Exception $e) {
		User::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/user');
	exit();
});

$app->get( '/admin/user/profile/{user_id}', function ( $request, $response, $args)
{
	User::verifyLogin( true);
	$pageAdmin = new PageAdmin( array( 'data' => array( 'headerTitle' => 'Admin - Perfil do Usuário', 'user' => $_SESSION[ User::SESSION ])));
	$pageAdmin->drawPage( 'user-profile', array( 'status' => User::getStatus(),'user' => User::getDatasById( $args['user_id'])));
});

$app->post( '/admin/user/profile/alter-password', function ()
{
	$user = new User();
	$user->setDatas( $_POST);
	
	try {
		$user->alterPassword();
		User::setStatus( 'Senha trocada com sucesso!', 'success');
	} catch (Exception $e) {
		User::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/user/profile/' . $user->getUserId());
	exit();

});

$app->get( '/admin/user/profile/disable-enable/{user_id}', function ( $request, $response, $args)
{
	User::verifyLogin( true);
	try {
		$response = User::disableEnableUser( $args['user_id']);

		if ( $response == 's') {
			User::setStatus( 'Usuário ativado com sucesso!', 'success');			
		} else {
			User::setStatus( 'Usuário desativado com sucesso!', 'danger');
		}


	} catch (Exception $e) {
		User::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/user/profile/' . $args['user_id']);
	exit();
});

$app->get( '/admin/user/show-all', function ()
{
	User::verifyLogin( true);
	sleep( 1);
	$response = User::listAll();
	$pageAdmin = new pageAdmin( array( 'header' => false, 'footer' => false));
	$informations = array( 'users' => $response);
	$pageAdmin->drawPage( 'user-table', $informations);
});

$app->get( '/admin/user/search/{filter}', function ( $request, $response, $args)
{
	User::verifyLogin( true);
	sleep( 1);
	$response = User::searchUsers( $args['filter']);
	$pageAdmin = new pageAdmin( array( 'header' => false, 'footer' => false));

	if ( count( $response)) {
		$informations = array( 'users' => $response);
		$pageAdmin->drawPage( 'user-table', $informations);
	} else {
		$informations = array( 'filter' => $args['filter']);
		$pageAdmin->drawPage( 'not-found', $informations);
	}
});