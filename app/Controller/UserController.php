<?php

namespace App\Controller;

use \App\Models\User;

class UserController
{
	/**
	 * Show list of users
	 *
	 * @return view
	 */
	public function indexAction()
	{
		$users = User::selectAllOrById();

		\App\View::make('users.index', [
			'users' => $users,
		]);
	}

	public function newAction()
	{
		\App\View::make('users.new');
	}

	public function createAction()
	{
		$name = isset($_POST['name']) ? $_POST['name'] : null;
		$email = isset($_POST['email']) ? $_POST['email'] : null;
		$gender = isset($_POST['gender']) ? $_POST['gender'] : null;
		$birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;

		if (User::save($name, $email, $gender, $birthdate)) {
			header('location: /');
			exit;
		}
	}

	public function editAction($id)
	{
		$user = User::selectAllOrById($id)[0];

		\App\View::make('users.edit', [
			'user' => $user,
		]);
	}

	public function updateAction()
	{
		$id = isset($_POST['id']) ? $_POST['id'] : null;
		$name = isset($_POST['name']) ? $_POST['name'] : null;
		$email = isset($_POST['email']) ? $_POST['email'] : null;
		$gender = isset($_POST['gender']) ? $_POST['gender'] : null;
		$birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : null;

		if (User::update($id, $name, $email, $gender, $birthdate)) {
			header('Location: /');
			exit;
		}
	}

	public function removeAction($id)
	{
		if (User::remove($id)) {
			header('Location: /');
			exit;
		}
	}
}