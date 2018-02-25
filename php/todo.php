<?php
require 'class/db.php';
// Receives data from POST and executes methods accordingly
if (isset($_POST["newTask"])) {
	$description = $_POST["description"];
	$addTask = new Task($description);
}
elseif (isset($_POST["status"])) {
	$id = $_POST["id"];
	$status = $_POST["status"];
	$update = new db;
	$update->taskStatus($id,$status);
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
