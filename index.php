<?php

require 'vendor/autoload.php';
require 'init.php';

$app = new \Slim\App([
		'settings' => [ 'displayErrorDetails' => true ]
	]);

$app->get('/', function() {
	$usersController = new \App\Controllers\UserController;
	$usersController->index();
});

$app->get('/new', function() {
	$userController = new \App\Controller\UserController;
	$userController->new();
});

$app->post('/create', function() {
	$userController = new \App\Controller\UserController;
	$userController->create();
});

$app->get('/edit/{id}', function($request) {
	$id = $request->getAttribute('id');

	$userController = new \App\Controller\UserController;
	$userController->edit($id);
});

$app->post('/update', function() {
	$userController = new \App\Controller\UserController;
	$userController->update();
});

$app->get('/remove/{id}', function($request) {
	$id = $request->getAttribute('id');

	$userController = new \App\Controller\UserController;
	$userController->remove($id);
});

$app->run();