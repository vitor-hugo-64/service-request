<?php

use \SR\PageAdmin;
use \SR\Model\User;
use \SR\Model\Sector;
use \SR\Model\Request;
use \SR\Model\ProblemType;

$app->get( '/admin/request', function ()
{
	$informations = array( 'headerTitle' => 'Admin - Request', 'user' => User::getSession());
	$pageAdmin = new PageAdmin( array( 'data' => $informations));
	$pageAdmin->drawPage( 'request', array( 'status' => Request::getStatus(), 'requests' => Request::listAll()));
});

$app->get( '/admin/request/insert', function ()
{
	$informations = array( 'headerTitle' => 'Admin - Nova solicitação', 'user' => User::getSession());
	$pageAdmin = new PageAdmin( array( 'data' => $informations));
	$pageAdmin->drawPage( 'request-insert', array( 'problems' => ProblemType::listAll()));
});

$app->post( '/admin/request/insert', function ()
{
	$request = new Request();
	$request->setDatas( $_POST);

	try {	
		$request->save();
		Request::setStatus( 'Solicitação feita com sucesso!', 'success');
	} catch (Exception $e) {
		Request::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/request');
	exit();
});

$app->get( '/admin/request/update/{requestId}', function ( $request, $response, $args)
{
	$informations = array( 'headerTitle' => 'Admin - Editar solicitação', 'user' => User::getSession());
	$pageAdmin = new PageAdmin( array( 'data' => $informations));
	$pageAdmin->drawPage( 'request-update', array( 'problems' => ProblemType::listAll(), 'request' => Request::getDatasById( $args['requestId'])));
});

$app->post( '/admin/request/update', function ()
{
	$request = new Request();
	$request->setDatas( $_POST);

	try {
		$request->save();
		Request::setStatus( 'Solicitação editada com sucesso!', 'success');
	} catch (Exception $e) {
		Request::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/request');
	exit();
});

$app->get( '/admin/request/cancel/{requestId}', function ( $request, $response, $args)
{
	try {
		Request::cancel( $args['requestId']);
		Request::setStatus( 'Solicitação cancelada com sucesso!', 'success');
	} catch (Exception $e) {
		Request::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/request');
	exit();
});

$app->get( '/admin/request/view/{requestId}', function ( $request, $response, $args)
{
	// echo json_encode( Request::getDatasById( $args['requestId']));
	$informations = array( 'headerTitle' => 'Admin - Editar solicitação', 'user' => User::getSession());
	$pageAdmin = new PageAdmin( array( 'data' => $informations));
	$pageAdmin->drawPage( 'request-view', array( 'problems' => ProblemType::listAll(), 'request' => Request::getDatasById( $args['requestId'])));
});

$app->get( '/admin/request/meet/{requestId}', function ( $request, $response, $args)
{
	$user = new User();
	$user->setDatas( User::getSession());
	Request::meet( $args['requestId'], $user->getUserId());
	header('Location: /service-request/admin/request/view/' .  $args['requestId']);
	exit();
});

$app->get( '/admin/request/stop-meet/{requestId}', function ( $request, $response, $args)
{
	$user = new User();
	$user->setDatas( User::getSession());
	Request::stopMeet( $args['requestId'], $user->getUserId());
	header('Location: /service-request/admin/request/view/' .  $args['requestId']);
	exit();
});