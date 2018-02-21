<?php 
require 'php/todo.php';
if(isset($_POST["edit"])){$task = new db;} else{die(header('Location: http://127.0.0.1/todo'));};
$id = $_POST["edit"];
$task = $task->getTask($id);
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>To-do</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div class="row justify-content-center">
			<div class="col-6">
			<form action="php/todo.php" method="POST">
				<div class="form-group">
					Task:
					<textarea name="description" class="form-control" rows="3"><?= $task['0']->description ?></textarea>
					<input type="hidden" name="id" value="<?= $id ?>">
					<input type="hidden" name="updateTask">
					<button type="submit" class="btn btn-lg btn-primary mt-2 form-control">Update</button>
				</div>
			</form>
			</div>
		</div>
		</div>
	</body>
</html>