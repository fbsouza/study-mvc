<?php

namespace App\Models;

use App\Database;

class User
{
	/**
	 * Get all users or get user by id
	 *
	 * @param $id user id
	 * @return array
	 */
	public static function selectAllOrById($id = null)
	{
		$db = new Database();
		$whereById = $id ? 'WHERE id = :id' : '';

		$sql = sprintf('SELECT * FROM users %s ORDER BY name ASC', $whereById);

		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public static function save($name, $email, $gender, $birthdate)
	{
		if (empty($name) || empty($email) || empty($gender) || empty($birthdate)) {
			echo "Volte e preencha todos os campos";
			return false;
		}

		$isoDate = dateConvert($birthdate);

		$database = new Database;
		$sql = 'INSERT INTO users(name, email, gender, birthdate) VALUES(:name, :email, :gender, :birthdate)';
		$stmt = $database->prepare($sql);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':gender', $gender);
		$stmt->bindParam(':birthdate', $isoDate);

		if ($stmt->execute()) {
			return true;
		} else {
			echo "Erro ao cadastrar";
			return false;
		}
	}

	public static function update($id, $name, $email, $gender, $birthdate)
	{
		if (empty($name) || empty($email) || empty($gender) || empty($birthdate)) {
			echo "Volte e preencha todos os campos";
			return false;
		}

		$isoDate = dateConvert($birthdate);

		$database = new Database();
		$sql = 'UPDATE users SET name =:name, email = :email, gender =:gender, birthdate = :birthdate WHERE id = :id';
		$stmt = $database->prepare($sql);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':gender', $gender);
		$stmt->bindParam(':birthdate', $isoDate);
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);

		if ($stmt->execute()) {
			return true;
		} else {
			echo "Erroa ao atualizar";
			return false;
		}
	}

	public static function remove($id)
	{
		if (empty($id)) {
			echo "ID não informado";
			exit;
		}

		$database = new Database();
		$sql = 'DELETE FROM users WHERE id = :id';
		$stmt = $database->prepare($sql);
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);

		if ($stmt->execute()) {
			return true;
		} else {
			echo "Erro ao remover";
			print_r($stmt->errorInfo());
			return false;
		}
	}
}