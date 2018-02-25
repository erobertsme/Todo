<?php
require 'tasks.php';

class db
{
	public $db_handler;

	function __construct(){
		require('config.php');
		try {
			$this->db_handler = new PDO("mysql:host=$config[host];dbname=$config[db]", $config['user'], $config['pass']);
			$this->db_handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (Exception $e) {
			print "Error: " . $e->getMessage();
			die();
		};
	}

	function __destruct(){
		$this->db_handler = null;
	}

	function getTasks() {
		$statement = $this->db_handler->prepare("SELECT * FROM `tasks`");
		$statement->execute();
		$statement = $statement->fetchAll(PDO::FETCH_OBJ);

		return $statement;
	}

	function getTask($id) {
		$statement = $this->db_handler->prepare("SELECT description FROM `tasks` WHERE `id`= :id");
		$statement->bindParam(':id', $id);
		$statement->execute();
		$statement = $statement->fetchAll(PDO::FETCH_OBJ);

		return $statement;
	}

	function addTask($description) {
		$statement = $this->db_handler->prepare("INSERT INTO `tasks` (`description`) VALUES (:description)");
		$statement->bindParam(':description', $description);
		$statement->execute();

		return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/todo');
	}

	function deleteTask($id) {
		$statement = $this->db_handler->prepare("DELETE FROM `tasks` WHERE `tasks`.`id`= :id");
		$statement->bindParam(':id', $id);
		$statement->execute();

		return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/todo');
	}

	function taskStatus($id, $status) {
		$statement = $this->db_handler->prepare("UPDATE `tasks` SET `status`=:status WHERE `id`= :id");
		$statement->bindParam(':id', $id);
		$statement->bindParam(':status', $status);
		$statement->execute();

		return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/todo');
	}

	function updateTask($id, $description){
		$statement = $this->db_handler->prepare("UPDATE `tasks` SET `description`=:description WHERE `id`= :id");
		$statement->bindParam(':id', $id);
		$statement->bindParam(':description', $description);
		$statement->execute();

		return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/todo');
	}

}
