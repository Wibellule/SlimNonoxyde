<?php
namespace App\Models;

use App\Lib\Core;
use PDO;

class Stuff {

	protected $core;

	function __construct() {
		$this->core = Core::getInstance();
		//$this->core->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	// Get all users
	public function getStuffs() {
		$r = array();

		$sql = "SELECT * FROM stuffs";
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
	public function getStuffById($id) {
		$r = array();

		$sql = "SELECT 1 * stuffs WHERE id=$id";
		$stmt = $this->core->dbh->prepare($sql);
		//$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

		if ($stmt->execute()) {
			$r = $stmt->fetchAll(PDO::FETCH_ASSOC);
		} else {
			$r = 0;
		}
		return $r;
	}

	// Insert a new user
	public function insertStuff($data) {
		try {
			$sql = "INSERT INTO stuffs (label, id_user, description)
			VALUES (:label, :id_user, :description)";

			$stmt = $this->core->dbh->prepare($sql);
			if ($stmt->execute($data)) {
				return $this->core->dbh->lastInsertId();;
			} else {
				return '0';
			}
		} catch(PDOException $e) {
			return $e->getMessage();
		}

	}

	// Update the data of an user
	public function updateStuff($data) {

	}

	// Delete user
	public function deleteStuff($id) {

	}

}
