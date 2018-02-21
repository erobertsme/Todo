<?php
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

	function getTasks() {
		$statement = $this->db_handler->prepare("SELECT * FROM `tasks`");
		$statement->execute();
		$statement = $statement->fetchAll(PDO::FETCH_OBJ);
		$this->db_handler = null;

		return $statement;
	}

	function addTask($name, $description) {
		$statement = $this->db_handler->prepare("INSERT INTO `tasks` (`name`, `description`) VALUES (:name, :description)");
		$statement->bindParam(':name', $name);
		$statement->bindParam(':description', $description);
		$statement->execute();
		$this->db_handler = null;

		return header('Location: http://127.0.0.1/todo');
	}

	function deleteTask($id) {
		$statement = $this->db_handler->prepare("DELETE FROM `tasks` WHERE `tasks`.`id` = :id");
		$statement->bindParam(':id', $id);
		$statement->execute();
		$this->db_handler = null;

		return header('Location: http://127.0.0.1/todo');
	}

	function completeTask($id) {
		$statement = $this->db_handler->prepare("UPDATE `tasks` SET `status`= 'complete' WHERE `id` = :id");
		$statement->bindParam(':id', $id);
		$statement->execute();
		$this->db_handler = null;

		return header('Location: http://127.0.0.1/todo');
	}

	function incompleteTask($id) {
		$statement = $this->db_handler->prepare("UPDATE `tasks` SET `status`= 'incomplete' WHERE `id` = :id");
		$statement->bindParam(':id', $id);
		$statement->execute();
		$this->db_handler = null;

		return header('Location: http://127.0.0.1/todo');
	}

	function updateTaskName($id, $name){
		$statement = $this->db_handler->prepare("UPDATE `tasks` SET `name`= ':name' WHERE `id` = :id");
		$statement->bindParam(':id', $id);
		$statement->bindParam(':name', $name);
		$statement->execute();
		$this->db_handler = null;

		return header('Location: http://127.0.0.1/todo');
	}

	function updateTaskDescription($id, $description){
		$statement = $this->db_handler->prepare("UPDATE `tasks` SET `description`= ':description' WHERE `id` = :id");
		$statement->bindParam(':id', $id);
		$statement->bindParam(':description', $description);
		$statement->execute();
		$this->db_handler = null;

		return header('Location: http://127.0.0.1/todo');
	}
}