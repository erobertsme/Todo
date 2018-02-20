<?php
require_once('config.php');
class db
{
	public $db_handler;
	private $config;

	function __construct(){
		$config = new dbConfig;
		try {
			$this->db_handler = new PDO("mysql:host=$config->host;dbname=$config->db", $config->user, $config->pass);
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

		return $statement;
	}

	function addTask($name, $description) {
		$statement = $this->db_handler->prepare("INSERT INTO `tasks` (`name`, `description`) VALUES (:name, :description)");
		$statement->bindParam(':name', $name);
		$statement->bindParam(':description', $description);
		$statement->execute();

		return header('Location: http://127.0.0.1/todo');
	}

	function deleteTask($id) {
		$statement = $this->db_handler->prepare("DELETE FROM `tasks` WHERE `tasks`.`id` = :id");
		$statement->bindParam(':id', $id);
		$statement->execute();

		return header('Location: http://127.0.0.1/todo');
	}

	function completeTask($id) {
		$statement = $this->db_handler->prepare("UPDATE `tasks` SET `status`= 'complete' WHERE `id` = :id");
		$statement->bindParam(':id', $id);
		$statement->execute();

		return header('Location: http://127.0.0.1/todo');
	}

	function incompleteTask($id) {
		$statement = $this->db_handler->prepare("UPDATE `tasks` SET `status`= 'incomplete' WHERE `id` = :id");
		$statement->bindParam(':id', $id);
		$statement->execute();

		return header('Location: http://127.0.0.1/todo');
	}
}