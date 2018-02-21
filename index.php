<?php require_once 'php/todo.php'; $todo = new db; $todo = $todo->getTasks(); ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>To-do</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	</head>
	<body>

	<div class="container">
		<div class="row mt-3 justify-content-center">
			<div class="col-6">
			<form action="php/todo.php" method="POST">
				<input type="hidden" name="newTask">
				<div class="input-group">
					<input type="text" name="description" class="form-control" placeholder="Task"></input>
					<div class="input-group-append">
						<button type="submit" class="btn btn-primary form-control">Add</button>
					</div>
				</div>
			</form>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-9">
				<ul class="list-group list-group-flush">
				<?php foreach ($todo as $task): ?>
						<li class="list-group-item<?php if ($task->status == 'complete'){echo(' disabled');}?>">
							<div class="row">
								<div class="col-11">
									<form action="update-task.php" method="POST" class="d-inline"><button class="btn btn-outline-primary" type="submit" value="<?= $task->id ?>" name="edit"><i class="far fa-edit"></i></button></form>

									<?php if ($task->status == 'complete'){
									echo('<form action="php/todo.php" method="POST" class="d-inline mr-2"><button class="btn btn-outline-secondary" type="submit" value="' . $task->id . '" name="incomplete"><i class="far fa-check-square"></i></button></form>');}
									elseif ($task->status == 'incomplete'){
									echo('<form action="php/todo.php" method="POST" class="d-inline mr-2"><button class="btn btn-outline-success" type="submit" value="' . $task->id . '" name="complete"><i class="far fa-square"></i></button></form>');}
									?>

									<?php if ($task->status == 'complete'){echo("<strike>$task->description</strike>");}elseif ($task->status == 'incomplete'){echo("$task->description");}?>
								</div>
								<div class="col-1">
									<form action="php/todo.php" method="POST" class="d-inline"><button class="btn btn-sm btn-outline-danger mt-1" type="submit" value="<?= $task->id ?>" name="delete" onclick="return confirm('Are you sure you want to delete this task?');"><i class="far fa-times-circle"></i></button></form>
								</div>
							</div>
						</li>
				<?php endforeach ?>
				</ul>
			</div>
		</div>
		
	</div>

	</body>
</html>