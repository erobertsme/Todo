<?php
require 'class/db.php';

// Gets all tasks for listing
$todo = new db;
$todo = $todo->getTasks('all');

// Receives data from POST and executes methods accordingly
// New Task
if (isset($_POST["newTask"]))
{
	$description = $_POST["description"];
	$addTask = new Task($description);
}
// Update Task Status
elseif (isset($_POST["status"]))
{
	$id = $_POST["id"];
	$status = $_POST["status"];
	$update = new db;
	$update->taskStatus($id,$status);
}
// Delete Task
elseif (isset($_POST["delete"]))
{
	$delete = new db;
	$delete->deleteTask($_POST["delete"]);
}
// Edit Task
elseif (isset($_POST["updateTask"]))
{
	$id = $_POST["id"];
	$description = $_POST["description"];
	$update = new db;
	$update->updateTask($id,$description);
}
//Get single task for editing
elseif(isset($_GET["edit"]))
{
	$editTask = new db;
	$id = $_GET["edit"];
	$editTask = $editTask->getTask($id);
};
