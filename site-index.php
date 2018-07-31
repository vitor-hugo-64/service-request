<?php

use \SR\Page;
use \SR\Model\User;

$app->get( '/', function ()
{
	$page = new Page( array( 'data' => array( 'headerTitle' => 'Inicio')));
	$page->drawPage();
});

$app->get( '/login', function () {
	$page = new Page( array( 'header' => false, 'footer' => false));
	$page->drawPage( 'login', array( 'status' => User::getStatus()));
});

$app->post( '/login', function () {
	try {
	
		User::login( $_POST);
		header('Location: /service-request/admin');

	} catch (Exception $e) {
		
		User::setStatus( $e->getMessage(), 'danger');
		header('Location: /service-request/login');
	}

	exit();

});