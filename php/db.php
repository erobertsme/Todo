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
		$items = $this->db_handler->prepare("SELECT * FROM `tasks`");
		$items->execute();
		$items = $items->fetchAll(PDO::FETCH_OBJ);

		return $items;
	}

	function addTask($name, $description) {
		$items = $this->db_handler->prepare("INSERT INTO `tasks` (`name`, `description`) VALUES ('$name', '$description')");
		$items->execute();

		return header('Location: http://127.0.0.1/todo');
	}

	function deleteTask($id) {
		$items = $this->db_handler->prepare("DELETE FROM `tasks` WHERE `tasks`.`id` = $id");
		$items->execute();

		return header('Location: http://127.0.0.1/todo');
	}

	function completeTask($id) {
		$items = $this->db_handler->prepare("UPDATE `tasks` SET `status`= 'complete' WHERE `id` = $id");
		$items->execute();

		return header('Location: http://127.0.0.1/todo');
	}

	function incompleteTask($id) {
		$items = $this->db_handler->prepare("UPDATE `tasks` SET `status`= 'incomplete' WHERE `id` = $id");
		$items->execute();

		return header('Location: http://127.0.0.1/todo');
	}
}