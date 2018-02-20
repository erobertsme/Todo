<?php
/*
class db
{
	public $db_handler;

	function __construct()
	{
		require_once('config.php');
		try {
			$this->db_handler = new PDO("mysql:host=$host;dbname=$db", $username, $password);
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



function getTasks() {
require_once('config.php');
	try {
		$db_connection = new PDO("mysql:host=$host;dbname=$db", $username, $password);
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
require('config.php');
	try {
		$db_connection = new PDO("mysql:host=$host;dbname=$db", $username, $password);
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
require('config.php');
	try {
		$db_connection = new PDO("mysql:host=$host;dbname=$db", $username, $password);
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
require('config.php');
	try {
		$db_connection = new PDO("mysql:host=$host;dbname=$db", $username, $password);
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
require('config.php');
	try {
		$db_connection = new PDO("mysql:host=$host;dbname=$db", $username, $password);
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