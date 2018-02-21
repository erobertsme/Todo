<?php

// Receives data from POST and executes methods accordingly
if (isset($_POST["newTask"])) {
	$description = $_POST["description"];
	$addTask = new Task($description);
}
elseif (isset($_POST["complete"])) {
	$complete = new db;
	$complete->completeTask($_POST["complete"]);
}
elseif (isset($_POST["incomplete"])) {
	$incomplete = new db;
	$incomplete->incompleteTask($_POST["incomplete"]);
}
elseif (isset($_POST["delete"])) {
	$delete = new db;
	$delete->deleteTask($_POST["delete"]);
}
elseif (isset($_POST["updateTask"])) {
	$id = $_POST["id"];
	$description = $_POST["description"];
	$update = new db;
	$update->updateTask($id,$description);
};


// This class seems kind of unecessary
class Task
{
	
	protected $description;
	protected $status;
	protected $created_at;
	protected $updated_at;

	function __construct($description)
	{
		$this->description = "$description";
		$this->status = incomplete;
		$this->created_at = date('Y-m-d H:i:s');

		$newTask = new db;
		$newTask->addTask($description);
	}

}


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

	function completeTask($id) {
		$statement = $this->db_handler->prepare("UPDATE `tasks` SET `status`='complete' WHERE `id`= :id");
		$statement->bindParam(':id', $id);
		$statement->execute();

		return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/todo');
	}

	function incompleteTask($id) {
		$statement = $this->db_handler->prepare("UPDATE `tasks` SET `status`='incomplete' WHERE `id`= :id");
		$statement->bindParam(':id', $id);
		$statement->execute();

		return header('Location: http://127.0.0.1/todo');
	}

	function updateTask($id, $description){
		$statement = $this->db_handler->prepare("UPDATE `tasks` SET `description`=:description WHERE `id`= :id");
		$statement->bindParam(':id', $id);
		$statement->bindParam(':description', $description);
		$statement->execute();

		return header('Location: http://' . $_SERVER['SERVER_NAME'] . '/todo');
	}

}

?>