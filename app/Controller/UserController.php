<?php

namespace App\Controller;

use \App\Models\User;

class UserController
{
	/**
	 * Show list of users
	 */
	public function indexAction()
	{
		$users = User::selectAllOrById();

		\App\View::make('users.index', [
			'users' => $users,
		]);
	}

	/**
	 * Show new user page
	 */
	public function newAction()
	{
		\App\View::make('users.new');
	}

	/**
	 * Create a new user
	 */
	public function createAction()
	{
		$gender = isset($_POST['gender']) ? $_POST['gender'] : null;

		if (User::save($_POST['name'], $_POST['email'], $gender, $_POST['birthdate'])) {
			header('location: /');
			exit;
		}
	}

	/**
	 * Show edit user page
	 */
	public function editAction($id)
	{
		\App\View::make('users.edit', [
			'user' => User::selectAllOrById($id)[0],
		]);
	}

	/**
	 * Update a existing user
	 */
	public function updateAction()
	{
		if (User::update($_POST['id'], $_POST['name'], $_POST['email'], $_POST['gender'], $_POST['birthdate'])) {
			header('Location: /');
			exit;
		}
	}

	/**
	 * Remove a existing user by id
	 */
	public function removeAction($id)
	{
		if (User::remove($id)) {
			header('Location: /');
			exit;
		}
	}
}