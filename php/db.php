<?php
/*
class db
{
	require_once('config.php');
	public $db_handler;
	private $config;

	function __construct()
	{
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

	function __get($query)
	{
		$items = $db_handler->prepare($query);
		$items->execute();
		$items = $items->fetchAll(PDO::FETCH_OBJ);
		return $items;
	}

	function __set($query)
	{
		
	}
}
*/
require_once ('config.php');

function getTasks() {
	try {
		$config = new dbConfig;
		$db_connection = new PDO("mysql:host=$config->host;dbname=$config->db", $config->user, $config->pass);
		$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$items = $db_connection->prepare("SELECT * FROM `tasks`");
		$items->execute();
		$items = $items->fetchAll(PDO::FETCH_OBJ);

		return $items;
	}
	catch (Exception $e) {
		print "Error: " . $e->getMessage();
		die();
	};

};

function addTask($name, $description) {
	try {
		$config = new dbConfig;
		$db_connection = new PDO("mysql:host=$config->host;dbname=$config->db", $config->user, $config->pass);
		$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = "INSERT INTO `tasks` (`name`, `description`) VALUES ('$name', '$description')";

		$items = $db_connection->exec($query);

		return header('Location: http://127.0.0.1/todo');
	}
	catch (Exception $e) {
		print "Error: " . $e->getMessage();
		die();
	};

};

function deleteTask($id) {
	try {
		$config = new dbConfig;
		$db_connection = new PDO("mysql:host=$config->host;dbname=$config->db", $config->user, $config->pass);
		$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = "DELETE FROM `tasks` WHERE `tasks`.`id` = $id";

		$items = $db_connection->exec($query);

		return header('Location: http://127.0.0.1/todo');
	}
	catch (Exception $e) {
		print "Error: " . $e->getMessage();
		die();
	};

};

function completeTask($id) {
	try {
		$config = new dbConfig;
		$db_connection = new PDO("mysql:host=$config->host;dbname=$config->db", $config->user, $config->pass);
		$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = "UPDATE `tasks` SET `status`= 'complete' WHERE `id` = $id";

		$items = $db_connection->exec($query);

		return header('Location: http://127.0.0.1/todo');
	}
	catch (Exception $e) {
		print "Error: " . $e->getMessage();
		die();
	};

};

function incompleteTask($id) {
	try {
		$config = new dbConfig;
		$db_connection = new PDO("mysql:host=$config->host;dbname=$config->db", $config->user, $config->pass);
		$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$query = "UPDATE `tasks` SET `status`= 'incomplete' WHERE `id` = $id";

		$items = $db_connection->exec($query);

		return header('Location: http://127.0.0.1/todo');
	}
	catch (Exception $e) {
		print "Error: " . $e->getMessage();
		die();
	};

};

?>