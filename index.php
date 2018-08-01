<?php

session_start();

require_once('vendor/autoload.php');

use \Slim\App;
use \SR\Page;

$config = array(
	'settings' => array(
		'addContentLengthHeader' => false,
	)
);

$app = new App();

require_once('site-index.php');
require_once('admin.php');
require_once('admin-direction.php');
require_once('admin-sector.php');
require_once('admin-user.php');
require_once('admin-problem.php');
require_once('admin-request.php');

$app->run();