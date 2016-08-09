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
	$userController = new \App\Controller\UserController;
	$userController->editAction($request->getAttribute('id'));
});

$app->put('/update', function() {
	$userController = new \App\Controller\UserController;
	$userController->updateAction();
});

$app->get('/remove/{id}', function($request) {
	$userController = new \App\Controller\UserController;
	$userController->removeAction($request->getAttribute('id'));
});

$app->run();