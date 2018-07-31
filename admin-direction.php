<?php

use \SR\PageAdmin;
use \SR\Model\Direction;
use \SR\Model\User;

$app->get( '/admin/direction', function ()
{
	User::verifyLogin( true);
	$pageAdmin = new PageAdmin( array( 'data' => array( 'headerTitle' => 'Admin - Direção', 'user' => $_SESSION[ User::SESSION ])));
	$pageAdmin->drawPage( 'direction', array( 'directions' => Direction::listAll(), 'status' => Direction::getStatus()));
});

$app->get( '/admin/direction/insert', function ()
{
	User::verifyLogin( true);
	$pageAdmin = new PageAdmin( array( 'data' => array( 'headerTitle' => 'Admin - Adicionar Direção', 'user' => $_SESSION[ User::SESSION ])));
	$pageAdmin->drawPage( 'direction-insert', $informations);
});

$app->post( '/admin/direction/insert', function ()
{
	$direction = new Direction();
	$direction->setDatas( $_POST);
	
	try {
		$direction->save();
		Direction::setStatus( 'Direção adicionada com sucesso!', 'success');
	} catch (Exception $e) {
		Direction::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/direction');
	exit();
});

$app->get( '/admin/direction/update/{direction_id}', function ( $request, $response, $args)
{
	User::verifyLogin( true);
	$pageAdmin = new pageAdmin( array( 'data' => array( 'headerTitle' => 'Admin - Editar Direção', 'user' => $_SESSION[ User::SESSION ])));
	$pageAdmin->drawPage( 'direction-update', array( 'direction' =>  Direction::getDatasById( $args['direction_id'])));
});

$app->post( '/admin/direction/update', function ()
{
	$direction = new Direction();
	$direction->setDatas( $_POST);

	try {
		$direction->save();
		Direction::setStatus( 'Direção editada com sucesso!', 'success');
	} catch (Exception $e) {
		Direction::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/direction');
	exit();
});

$app->get( '/admin/direction/delete/{direction_id}', function ( $request, $response, $args)
{
	User::verifyLogin( true);
	$direction = new Direction();

	try {
		$direction->delete( $args['direction_id']);
		Direction::setStatus( 'Direção excluída com sucesso!', 'success');		
	} catch (Exception $e) {
		Direction::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/direction');
	exit();
});

$app->get( '/admin/direction/show-all', function ()
{
	User::verifyLogin( true);
	sleep( 1);
	$response = Direction::listAll();
	$pageAdmin = new pageAdmin( array( 'header' => false, 'footer' => false));
	$informations = array( 'directions' => $response);
	$pageAdmin->drawPage( 'direction-table', $informations);
});

$app->get( '/admin/direction/search/{filter}', function ( $request, $response, $args)
{
	User::verifyLogin( true);
	sleep( 1);
	$response = Direction::searchDirections( $args['filter']);
	$pageAdmin = new pageAdmin( array( 'header' => false, 'footer' => false));

	if ( count( $response)) {
		$informations = array( 'directions' => $response);
		$pageAdmin->drawPage( 'direction-table', $informations);
	} else {
		$informations = array( 'filter' => $args['filter']);
		$pageAdmin->drawPage( 'not-found', $informations);
	}
});