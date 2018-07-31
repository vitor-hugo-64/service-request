<?php

use \SR\PageAdmin;
use \SR\Model\User;
use \SR\Model\ProblemType;

$app->get( '/admin/problem', function ()
{
	$pageAdmin = new PageAdmin( array( 'data' => array( 'headerTitle' => 'Problema', 'user' => User::getSession())));
	$informations = array( 'problems' => ProblemType::listAll(), 'status' => ProblemType::getStatus());
	$pageAdmin->drawPage( 'problem', $informations);
});

$app->get( '/admin/problem/insert', function ()
{
	$pageAdmin = new PageAdmin( array( 'data' => array( 'headerTitle' => 'Problema - Adicionar', 'user' => User::getSession())));
	$pageAdmin->drawPage( 'problem-insert');
});

$app->post( '/admin/problem/insert', function ()
{
	$problemType = new ProblemType();

	try {
		$problemType->setDatas( $_POST);
		$problemType->save();

	} catch (Exception $e) {
		ProblemType::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/problem');
	exit();
});

$app->get( '/admin/problem/update/{problemTypeId}', function ( $request, $response, $args)
{
	$pageAdmin = new PageAdmin( array( 'data' => array( 'headerTitle' => 'Problema - Editar', 'user' => User::getSession())));
	$informations = array( 'problem' => ProblemType::getDatasById( $args['problemTypeId']));
	$pageAdmin->drawPage( 'problem-update', $informations);
});

$app->post( '/admin/problem/update', function ()
{
	$problemType = new ProblemType();

	try {
		$problemType->setDatas( $_POST);
		$problemType->save();
		ProblemType::setStatus( 'Tipo de problema editado com sucesso!', 'success');
	} catch (Exception $e) {
		ProblemType::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/problem');
	exit();
});

$app->get( '/admin/problem/delete/{problemTypeId}', function ( $request, $response, $args)
{
	$problemType = new ProblemType();
	
	try {
		$problemType->delete( $args['problemTypeId']);
		ProblemType::setStatus( 'Problema excluído com sucesso!', 'success');
	} catch (Exception $e) {
		ProblemType::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/problem');
	exit();
});

$app->get( '/admin/problem/show-all', function ()
{
	User::verifyLogin( true);
	sleep( 1);
	$response = ProblemType::listAll();
	$pageAdmin = new pageAdmin( array( 'header' => false, 'footer' => false));
	$informations = array( 'problems' => $response);
	$pageAdmin->drawPage( 'problem-table', $informations);
});

$app->get( '/admin/problem/search/{filter}', function ( $request, $response, $args)
{
	User::verifyLogin( true);
	sleep( 1);
	$response = ProblemType::searchProblems( $args['filter']);
	$pageAdmin = new pageAdmin( array( 'header' => false, 'footer' => false));

	if ( count( $response)) {
		$informations = array( 'problems' => $response);
		$pageAdmin->drawPage( 'problem-table', $informations);
	} else {
		$informations = array( 'filter' => $args['filter']);
		$pageAdmin->drawPage( 'not-found', $informations);
	}
});
