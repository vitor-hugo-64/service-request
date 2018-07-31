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

$app->get( '/admin/test', function ()
{
	Request::listAll();
});