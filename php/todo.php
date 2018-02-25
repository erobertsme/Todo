<?php
require 'classes/db.php';
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
