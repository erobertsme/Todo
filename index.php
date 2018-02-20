<!DOCTYPE html>
<?php
include 'php/db.php';
$todo = new db;
$todo = $todo->getTasks();
if (isset($_POST["name"]) and isset($_POST["description"])) {
	$name = $_POST["name"];
	$description = $_POST["description"];
	$newTask = new db;
	$newTask->addTask($name,$description);
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
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>To-do</title>
		<!-- <style type="text/css" src="css/style.css"></style> -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>

	<div class="container">
		<div class="row">
			<?php foreach ($todo as $task): ?>
				<div class="col-4">
					<div class="card text-center my-2 <?php if ($task->status == 'complete'){echo('border-success');}?>">
						<div class="card-header <?php if ($task->status == 'complete'){echo('bg-success');}?>"><h3 class="card-title"><?= $task->name ?></h3></div>

						<div class="card-body"><p class="card-text h4"><?= $task->description ?></p>
						<?php if ($task->status == 'complete'){
						echo('<form action="' . $_SERVER['PHP_SELF'] . '" method="POST" class="d-inline"><button class="btn btn-lg btn-outline-secondary mt-3" type="submit" value="' . $task->id . '" name="incomplete">Mark Incomplete</button></form>');}
						elseif ($task->status == 'incomplete'){
						echo('<form action="' . $_SERVER['PHP_SELF'] . '" method="POST" class="d-inline"><button class="btn btn-lg btn-outline-success mt-3" type="submit" value="' . $task->id . '" name="complete">Mark Complete</button></form>');}
						?>
						<br><form action="<?php $_PHP_SELF ?>" method="POST" class="d-inline"><button class="btn btn-sm btn-outline-danger mt-3" type="submit" value="<?= $task->id ?>" name="delete" onclick="return confirm('Are you sure you want to delete this task?');">Delete</button></form>
					</div></div>
				</div>
			<?php endforeach ?>
		
		</div>
		<div class="row justify-content-center">
			<div class="col-6">
			<form action="<?php $_PHP_SELF ?>" method="POST">
				<div class="form-group">
					Task:
					<input type="text" name="name" class="form-control">
					Description:
					<textarea name="description" class="form-control" rows="3"></textarea><button type="submit" class="btn btn-lg btn-primary form-control">Add</button>
				</div>
			</form>
			</div>
		</div>
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.21/jquery-ui.min.js" type="text/javascript"></script>
	<script type="text/javascript">
	function autorun()
	{

	}
	if (document.addEventListener) document.addEventListener("DOMContentLoaded", autorun, false);
	else if (document.attachEvent) document.attachEvent("onreadystatechange", autorun);
	else window.onload = autorun;
		</script>
	</body>
</html>