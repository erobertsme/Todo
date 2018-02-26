<?php
require 'tasks.php';

class db
{
	public $dbHandler;

	// Creates new connection to the database using information from config.php
	function __construct(){
		require($_SERVER['DOCUMENT_ROOT'] . '/todo/php/config.php');
		try {
			$this->dbHandler = new PDO("mysql:host=$config[host];dbname=$config[db]", $config['user'], $config['pass']);
			$this->dbHandler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (Exception $e) {
			print "Error: " . $e->getMessage();
			die();
		};
	}

	function __destruct(){
		$this->dbHandler = null;
	}

	// Get all tasks for tasks list
	function getTasks() {
		$statement = $this->dbHandler->prepare("SELECT * FROM `tasks`");
		$statement->execute();
		$statement = $statement->fetchAll(PDO::FETCH_OBJ);

		return $statement;
	}

	// Get single task for editing
	function getTask($id) {
		$statement = $this->dbHandler->prepare("SELECT description FROM `tasks` WHERE `id`= :id");
		$statement->bindParam(':id', $id);
		$statement->execute();
		$statement = $statement->fetchAll(PDO::FETCH_OBJ);

		return $statement;
	}

	// Add new task
	function addTask($description) {
		$statement = $this->dbHandler->prepare("INSERT INTO `tasks` (`description`) VALUES (:description)");
		$statement->bindParam(':description', $description);
		$statement->execute();

		return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/todo');
	}

	// Delete task
	function deleteTask($id) {
		$statement = $this->dbHandler->prepare("DELETE FROM `tasks` WHERE `tasks`.`id`= :id");
		$statement->bindParam(':id', $id);
		$statement->execute();

		return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/todo');
	}

	// Update task status
	function taskStatus($id, $status) {
		$statement = $this->dbHandler->prepare("UPDATE `tasks` SET `status`=:status WHERE `id`= :id");
		$statement->bindParam(':id', $id);
		$statement->bindParam(':status', $status);
		$statement->execute();

		return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/todo');
	}

	// Edit task
	function updateTask($id, $description){
		$statement = $this->dbHandler->prepare("UPDATE `tasks` SET `description`=:description WHERE `id`= :id");
		$statement->bindParam(':id', $id);
		$statement->bindParam(':description', $description);
		$statement->execute();

		return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/todo');
	}

}
