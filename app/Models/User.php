<?php

namespace App\Models;

use App\Database;

class User
{
	/**
	 * Get all users or get user by id
	 *
	 * @param integer $id
	 * @return array
	 */
	public static function selectAllOrById($id = null)
	{
		$db = new Database();

		$sql = sprintf(
			'SELECT * FROM users %s ORDER BY name ASC',
			$id ? 'WHERE id = :id' : '');

		$stmt = $db->prepare($sql);
		$stmt->bindParam(':id', $id, \PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 *	Save a new user
	 *
	 * @param string $name
	 * @param string $email
	 * @param string $gender
	 * @param string $birthdate
	 * @return boolean
	 */
	public static function save($name, $email, $gender, $birthdate)
	{
		$db = new Database;

		if (self::isValid($name, $email, $gender, $birthdate)) {
			$sql = 'INSERT INTO
						users(name, email, gender, birthdate)
					VALUES
						(:name, :email, :gender, :birthdate)';

			$stmt = $db->prepare($sql);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':gender', $gender);
			$stmt->bindParam(':birthdate', dateConvert($birthdate));

			try {
				$stmt->execute();
				return true;
			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}
		}

		echo "Volte e preencha todos os campos";
		return false;
	}

	/**
	 *	Update a user
	 *
	 * @param integer $id
	 * @param string $name
	 * @param string $email
	 * @param string $gender
	 * @param string $birthdate
	 * @return boolean
	 */
	public static function update($id, $name, $email, $gender, $birthdate)
	{
		$db = new Database();

		if (self::isValid($name, $email, $gender, $birthdate)) {
			$sql = 'UPDATE
						users
					SET
						name =:name, email = :email, gender =:gender, birthdate = :birthdate
					WHERE
						id = :id';

			$stmt = $db->prepare($sql);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':gender', $gender);
			$stmt->bindParam(':birthdate', dateConvert($birthdate));
			$stmt->bindParam(':id', $id, \PDO::PARAM_INT);

			try {
				$stmt->execute();
				return true;
			} catch (Exception $e) {
				echo $e->getMessage();
				return false;
			}
		}

		echo "Volte e preencha todos os campos";
		return false;
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

	/**
	 * Verifies that all required fields have been filled
	 *
	 * @param string $name
	 * @param string $email
	 * @param string $gender
	 * @param string $birthdate
	 * @return boolean
	 */
	public static function isValid($name, $email, $gender, $birthdate)
	{
		return $name && $email && $gender && $birthdate
			? true
			: false;
	}
}