<?php
require 'php/todo.php'; $todo = new db; $todo = $todo->getTasks('all');
if(isset($_GET["edit"])){$editTask = new db;$id = $_GET["edit"];$editTask = $editTask->getTask($id);};
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>To-do</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
	</head>
	<body>

	<div class="container">
		<div class="row">
			<div class="col mb-5 pb-5">
				<ul class="list-group list-group-flush">

				<?php foreach ($todo as $task): ?>
					<li class="list-group-item<?php if ($task->status == 'complete'){echo(' disabled');}?>">
						<div class="row">

							<div class="col-1 my-auto p-0">
								<form action="/todo" method="GET" class="d-inline"><button class="btn btn-outline-primary m-0" type="submit" value="<?= $task->id ?>" name="edit"><i class="far fa-edit p-1"></i></button></form>
							</div>

							<div class="col-1 my-auto p-0">
								<?php if ($task->status == 'complete'): ?>
									<form action="php/todo.php" method="POST" class="d-inline"><button class="btn btn-outline-secondary" type="submit" value="<?= $task->id ?>" name="incomplete"><i class="far fa-check-square p-1"></i></button></form>
								<?php elseif ($task->status == 'incomplete'): ?>
									<form action="php/todo.php" method="POST" class="d-inline"><button class="btn btn-outline-success" type="submit" value="<?= $task->id ?>" name="complete"><i class="far fa-square p-1"></i></button></form>
								<?php endif; ?>
							</div>

							<div class="col">
								<h3>
									<?php if ($task->status == 'complete'): ?>
										<strike><?= $task->description ?></strike>
									<?php elseif ($task->status == 'incomplete'): ?>
										<?= $task->description ?>
									<?php endif; ?>
								</h3>
							</div>

							<div class="col-1 ml-2 my-auto">
								<form action="php/todo.php" method="POST" class="d-inline">
									<button class="btn btn-sm btn-outline-danger mt-1" type="submit" value="<?= $task->id ?>" name="delete" onclick="return confirm('Are you sure you want to delete this task?');"><i class="far fa-times-circle py-1"></i></button>
								</form>
							</div>

						</div>
					</li>
				<?php endforeach ?>

				</ul>
			</div>
		</div>

		<div class="row fixed-bottom justify-content-center">
			<div class="col mx-5">


			<?php if(isset($_GET["edit"])): ?>
				<form action="php/todo.php" method="POST">
					<input type="hidden" name="updateTask"/>
					<input type="hidden" name="id" value="<?= $id ?>"/>
					<div class="input-group input-group-lg">
						<input type="text" name="description" class="form-control" value="<?= $editTask['0']->description ?>" onfocus="var temp_value=this.value; this.value=''; this.value=temp_value" autocomplete="off" autofocus/>
						<div class="input-group-append">
							<button type="submit" class="btn btn-primary form-control">Update</button>
						</div>
					</div>
				</form>
			<?php else: ?>
			<form action="php/todo.php" method="POST">
				<input type="hidden" name="newTask"/>
				<div class="input-group input-group-lg">
					<input type="text" name="description" class="form-control" placeholder="Task" autocomplete="off" autofocus/>
					<div class="input-group-append">
						<button type="submit" class="btn btn-primary form-control">Add</button>
					</div>
				</div>
			</form>
		<?php endif; ?>

			</div>
		</div>

	</div>

	</body>
</html>
