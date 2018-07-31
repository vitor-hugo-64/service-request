<?php

use \SR\PageAdmin;
use \SR\Model\Sector;
use \SR\Model\Direction;
use \SR\Model\User;

$app->get( '/admin/sector', function ()
{
	User::verifyLogin( true);
	$pageAdmin = new PageAdmin( array( 'data' => array( 'headerTitle' => 'Admin - Setor', 'user' => $_SESSION[ User::SESSION ])));
	$pageAdmin->drawPage( 'sector', array( 'sectors' => Sector::listAll(), 'status' => Sector::getStatus()));
});

$app->get( '/admin/sector/insert', function ()
{
	User::verifyLogin( true);
	$pageAdmin = new PageAdmin( array( 'data' => array( 'headerTitle' => 'Admin - Adicionar Setor', 'user' => $_SESSION[ User::SESSION ])));
	$pageAdmin->drawPage( 'sector-insert', array( 'directions' => Direction::listAll()));
});

$app->post( '/admin/sector/insert', function ()
{
	$sector = new Sector();
	$sector->setDatas( $_POST);

	try {
		$sector->save();
		Sector::setStatus( 'Setor adicionado com sucesso!', 'success');
	} catch (Exception $e) {
		Sector::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/sector');
	exit();
});

$app->get( '/admin/sector/update/{sector_id}', function ( $request, $response, $args)
{
	User::verifyLogin( true);
	$pageAdmin = new pageAdmin( array( 'data' => array( 'headerTitle' => 'Admin - Editar Setor', 'user' => $_SESSION[ User::SESSION ])));
	$pageAdmin->drawPage( 'sector-update', array( 'sector' => Sector::getDatasById( $args['sector_id']), 'directions' => Direction::listAll()));
});

$app->post( '/admin/sector/update', function ( )
{
	$sector = new Sector();
	$sector->setDatas( $_POST);

	try {
		$sector->save();
		Sector::setStatus( 'Setor editado com sucesso!', 'success');
	} catch (Exception $e) {
		Sector::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/sector');
	exit();
});

$app->get( '/admin/sector/delete/{sector_id}', function ( $request, $response, $args)
{
	User::verifyLogin( true);
	$sector = new Sector();

	try {
		$sector->delete( $args['sector_id']);
		Sector::setStatus( 'Setor excluído com sucesso!', 'success');
	} catch (Exception $e) {
		Sector::setStatus( $e->getMessage(), 'danger');
	}

	header('Location: /service-request/admin/sector');
	exit();
});

$app->get( '/admin/sector/show-all', function ()
{
	User::verifyLogin( true);
	sleep( 1);
	$response = Sector::listAll();
	$pageAdmin = new pageAdmin( array( 'header' => false, 'footer' => false));
	$informations = array( 'sectors' => $response);
	$pageAdmin->drawPage( 'sector-table', $informations);
});

$app->get( '/admin/sector/search/{filter}', function ( $request, $response, $args)
{
	User::verifyLogin( true);
	sleep( 1);
	$response = Sector::searchSectors( $args['filter']);
	$pageAdmin = new pageAdmin( array( 'header' => false, 'footer' => false));

	if ( count( $response)) {
		$informations = array( 'sectors' => $response);
		$pageAdmin->drawPage( 'sector-table', $informations);
	} else {
		$informations = array( 'filter' => $args['filter']);
		$pageAdmin->drawPage( 'not-found', $informations);
	}
});