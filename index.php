<?php

require 'vendor/autoload.php';
require 'init.php';

$app = new \Slim\App([
		'settings' => [ 'displayErrorDetails' => true ]
	]);

$app->get('/', function() {
	$userController = new \App\Controller\UserController;
	$userController->indexAction();
});

$app->get('/new', function() {
	$userController = new \App\Controller\UserController;
	$userController->newAction();
});

$app->post('/create', function() {
	$userController = new \App\Controller\UserController;
	$userController->createAction();
});

$app->get('/edit/{id}', function($request) {
	$id = $request->getAttribute('id');

	$userController = new \App\Controller\UserController;
	$userController->editAction($id);
});

$app->post('/update', function() {
	$userController = new \App\Controller\UserController;
	$userController->updateAction();
});

$app->get('/remove/{id}', function($request) {
	$id = $request->getAttribute('id');

	$userController = new \App\Controller\UserController;
	$userController->removeAction($id);
});

$app->run();