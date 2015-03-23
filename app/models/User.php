<?php
namespace App\Models;

use App\Lib\Core;
use PDO;

class User {

	protected $core;

	function __construct() {
		$this->core = Core::getInstance();
		//$this->core->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	// Get all users
	public function getUsers($page = 1) {
		$r = array();

		$p = $page*5 - 5;

		$sql = "SELECT * FROM users LIMIT $p, 5";
		$stmt = $this->core->dbh->prepare($sql);
		//$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {
			$r = 0;
		}
		return $r;
	}

	// Get user by the Id
	public function getUserById($id) {
		$r = array();

		$sql = "SELECT 1 * users WHERE id=$id";
		$stmt = $this->core->dbh->prepare($sql);
		//$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {
			$r = 0;
		}
		return $r;
	}

	// Get user by the Login
	public function getUserByLogin($email, $pass) {
		$r = array();

		$sql = "SELECT * FROM users WHERE email=:email AND password=:pass";
		$stmt = $this->core->dbh->prepare($sql);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':pass', $pass, PDO::PARAM_STR);

		if ($stmt->execute()) {
			$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {
			$r = 0;
		}
		return $r;
	}

	// Insert a new user
	public function insertUser($data) {
		try {
			$sql = "INSERT INTO users (firstname, lastname, email, password)
					VALUES (:firstname, :lastname, :email, :password)";

			$stmt = $this->core->dbh->prepare($sql);
			$stmt->bindValue("firstname", $data['firstname'], PDO::PARAM_STR);
			$stmt->bindValue("lastname", $data['lastname'], PDO::PARAM_STR);
			$stmt->bindValue("email", $data['email'], PDO::PARAM_STR);
			$stmt->bindValue("password", $data['password'], PDO::PARAM_STR);

			if ($stmt->execute()) {
				return $this->core->dbh->lastInsertId();
			} else {
				//echo $stmt->errorInfo());
				return 0;
			}
		} catch(PDOException $e) {
        	//log $e->getMessage();
			return 0;
    	}
	}

	// Update the data of an user
	public function updateUser($data) {
		try {
			$sql = "UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password";

			$stmt = $this->core->dbh->prepare($sql);
			$stmt->bindValue("firstname", $data['firstname'], PDO::PARAM_STR);
			$stmt->bindValue("lastname", $data['lastname'], PDO::PARAM_STR);
			$stmt->bindValue("email", $data['email'], PDO::PARAM_STR);
			$stmt->bindValue("password", $data['password'], PDO::PARAM_STR);

			if ($stmt->execute($data)) {
				return 1;
			} else {
				return '0';
			}
		} catch(PDOException $e) {
			return $e->getMessage();
		}
	}

	// Delete user
	public function deleteUser($id) {
		try {
			$sql = "DELETE FROM users WHERE id = :id";

			$stmt = $this->core->dbh->prepare($sql);
			$stmt->bindValue("id", $id, PDO::PARAM_INT);

			if ($stmt->execute()) {
				return 1;
			} else {
				//var_dump($stmt->errorInfo());
				return 0;
			}
		} catch(PDOException $e) {
			//echo $e->getMessage();
			return 0;
		}

	}

}
