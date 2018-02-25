<?php
require 'php/todo.php';
if(isset($_POST["edit"])){$task = new db;} else{die(header('Location: http://' . $_SERVER['SERVER_NAME'] . '/todo'));};
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
			<div class="col pt-5">

			<form action="php/todo.php" method="POST">
				<input type="hidden" name="updateTask">
				<input type="hidden" name="id" value="<?= $id ?>">
				<div class="input-group input-group-lg">
					<input type="text" name="description" class="form-control" placeholder="<?= $task['0']->description ?>"></input>
					<div class="input-group-append">
						<button type="submit" class="btn btn-primary form-control">Update</button>
					</div>
				</div>
			</form>

			</div>
		</div>
		</div>
	</body>
</html>
