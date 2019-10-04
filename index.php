<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Boinc Headless Viewer</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="jumbotron jumbotron-fluid">
				<p class="display-4">Boinc Headless Viewer</p>
				<p class="lead">This web app will show you information about the boinc client running on your computer/server.</p>
			</div>
	<div class="card-columns">
		<?php
		//Holds Active Tasks
$primeGridAccount = file_get_contents('/var/lib/boinc-client/client_state.xml');


//XML Parser
$xml = simplexml_load_string($primeGridAccount) or die('Error: Cannot create object');

if(!empty($xml->active_task_set) && !empty($xml->active_task_set->active_task)) {
	foreach($xml->active_task_set->active_task as $task) { ?>
		<div class="card">
			<div class="card-header text-white bg-primary mb-3"><?= $task->result_name; ?></div>
			<div class="card-body">
				<div class="card-title">Status: <?= ($task->active_task_state) ? "Active" : "Inactive"; ?></div>
				<div class="card-body">
					<ul>
						<li>App Version Number: <?= $task->app_version_num; ?></li>
						<li>Checkpoint CPU Time: <?= $task->checkpoint_cpu_time; ?></li>
						<li>Checkpoint Elapsed Time: <?= $task->checkpoint_elapsed_time; ?></li>
						<li>Checkpoint Fraction Done: <?= $task->checkpoint_fraction_done; ?></li>
						<li>Checkpoint Fraction Done Elapsed Time: <?= $task->checkpoint_fraction_done_elapsed_time; ?></li>
						<li>Current CPU Time: <?= $task->current_cpu_time; ?></li>
					</ul>
				</div>
			</div>
		</div>
	<?php }
}

	?>
</div>
	</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>