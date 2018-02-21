<?php
/*

Note: This is a Work In Progress at the moment

Tasks
	-Name
	-Description
	-Status (default: incomplete)
	-Created_at

todo:
updated_at

*/

if (isset($_POST["new"])) {
	$name = $_POST["name"];
	$description = $_POST["description"];
	$addTask = new Task($name, $description);
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
elseif (isset($_POST["updated"])) {
	$id = $_POST["id"];
	$name = $_POST["name"];
	$description = $_POST["description"];
	$update = new db;
	$update->updateTask($id, $name, $description);
};

class Task
{
	
	protected $name;
	protected $description;
	protected $status;
	protected $created_at;
	protected $updated_at;

	function __construct($name, $description)
	{
		$this->name = "$name";
		$this->description = "$description";
		$this->status = incomplete;
		$this->created_at = date('Y-m-d H:i:s');

		$newTask = new db;
		$newTask->addTask($name, $description);
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

	function getTasks() {
		$statement = $this->db_handler->prepare("SELECT * FROM `tasks`");
		$statement->execute();
		$statement = $statement->fetchAll(PDO::FETCH_OBJ);
		$this->db_handler = null;

		return $statement;
	}

	function getTask($id) {
		$statement = $this->db_handler->prepare("SELECT name, description FROM `tasks` WHERE `id`= :id");
		$statement->bindParam(':id', $id);
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
		$statement = $this->db_handler->prepare("DELETE FROM `tasks` WHERE `tasks`.`id`= :id");
		$statement->bindParam(':id', $id);
		$statement->execute();
		$this->db_handler = null;

		return header('Location: http://127.0.0.1/todo');
	}

	function completeTask($id) {
		$statement = $this->db_handler->prepare("UPDATE `tasks` SET `status`='complete' WHERE `id`= :id");
		$statement->bindParam(':id', $id);
		$statement->execute();
		$this->db_handler = null;

		return header('Location: http://127.0.0.1/todo');
	}

	function incompleteTask($id) {
		$statement = $this->db_handler->prepare("UPDATE `tasks` SET `status`='incomplete' WHERE `id`= :id");
		$statement->bindParam(':id', $id);
		$statement->execute();
		$this->db_handler = null;

		return header('Location: http://127.0.0.1/todo');
	}

	function updateTask($id, $name, $description){
		$statement = $this->db_handler->prepare("UPDATE `tasks` SET `name`=:name, `description`=:description WHERE `id`= :id");
		$statement->bindParam(':id', $id);
		$statement->bindParam(':name', $name);
		$statement->bindParam(':description', $description);
		$statement->execute();
		$this->db_handler = null;

		return header('Location: http://127.0.0.1/todo');
	}

}

?>