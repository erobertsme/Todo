<?php

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
		$stuff = $db_handler->prepare($query);
		$stuff->execute();
		$stuff = $stuff->fetchAll(PDO::FETCH_OBJ);
		return $stuff;
	}

	function __set($query)
	{
		
	}
}




function getTasks() {
require_once('config.php');
	try {
		$db_connection = new PDO("mysql:host=$host;dbname=$db", $username, $password);
		$db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stuff = $db_connection->prepare("SELECT * FROM `tasks`");
		$stuff->execute();
		$stuff = $stuff->fetchAll(PDO::FETCH_OBJ);

		return $stuff;
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

		$stuff = $db_connection->exec($query);

		return header('Location: http://127.0.0.1/');
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

		$stuff = $db_connection->exec($query);

		return header('Location: http://127.0.0.1/');
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

		$stuff = $db_connection->exec($query);

		return header('Location: http://127.0.0.1/');
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

		$stuff = $db_connection->exec($query);

		return header('Location: http://127.0.0.1/');
	}
	catch (Exception $e) {
		print "Error: " . $e->getMessage();
		die();
	};

};

?>