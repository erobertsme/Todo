<?php require_once 'php/todo.php'; $todo = new db; $todo = $todo->getTasks(); ?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>To-do</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	</head>
	<body>

	<div class="container">
		<div class="row">
			<?php foreach ($todo as $task): ?>
				<div class="col-4 p-1">
					<div class="card text-center <?php if ($task->status == 'complete'){echo('border-success');}?>">

						<div class="card-header <?php if ($task->status == 'complete'){echo('bg-success');}?>"><h4 class="card-title"><?= ucwords($task->name) ?></h4></div>

						<div class="card-body" style="min-height: 150px;">
							<p class="card-text h5"><?= $task->description ?></p>
						</div>

						<div class="card-footer bg-transparent p-2">
							<form action="update-task.php" method="POST" class="d-inline"><button class="btn btn-outline-primary" type="submit" value="<?= $task->id ?>" name="update">Update</button></form>
							<?php if ($task->status == 'complete'){
							echo('<form action="php/todo.php" method="POST" class="d-inline"><button class="btn btn-outline-secondary" type="submit" value="' . $task->id . '" name="incomplete">Mark Incomplete</button></form>');}
							elseif ($task->status == 'incomplete'){
							echo('<form action="php/todo.php" method="POST" class="d-inline"><button class="btn btn-outline-success" type="submit" value="' . $task->id . '" name="complete">Mark Complete</button></form>');}
							?>
							<form action="php/todo.php" method="POST" class="d-inline"><button class="btn btn-sm btn-outline-danger ml-3" type="submit" value="<?= $task->id ?>" name="delete" onclick="return confirm('Are you sure you want to delete this task?');">Delete</button></form>
						</div>

					</div>
				</div>
			<?php endforeach ?>
		
		</div>
		<div class="row justify-content-center">
			<div class="col-6">
			<form action="php/todo.php" method="POST">
				<div class="form-group">
					Task:
					<input type="text" name="name" class="form-control">
					Description:
					<textarea name="description" class="form-control" rows="3"></textarea>
					<input type="hidden" name="new">
					<button type="submit" class="btn btn-lg btn-primary form-control">Add</button>
				</div>
			</form>
			</div>
		</div>
	</div>

	</body>
</html>