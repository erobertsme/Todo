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

require 'db.php';

if (isset($_POST["name"]) and isset($_POST["description"])) {
	$name = $_POST["name"];
	$description = $_POST["description"];
	$addTask = new Task($name,$description);
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
};

class Task
{
	
	protected $name;
	protected $description;
	protected $status;
	protected $created_at;
	protected $updated_at;

	function __construct($name,$description)
	{
		$this->name = "$name";
		$this->description = "$description";
		$this->status = incomplete;
		$this->created_at = date('Y-m-d H:i:s');

		$newTask = new db;
		$newTask->addTask($name,$description);
	}

}

?>