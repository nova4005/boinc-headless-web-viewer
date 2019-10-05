<?php include 'header.php';?>
<div class="jumbotron jumbotron-fluid">
				<div class="container">
					<p class="display-4">Boinc Headless Viewer</p>
				<p class="lead">This web app will show you information about the boinc client running on your computer/server.</p>
				</div>
			</div>
	<div class="container">
		<div class="row">
	<div class="card-columns">
		<?php
//Holds Active Tasks
$primeGridAccount = file_get_contents('/var/lib/boinc-client/client_state.xml');

//XML Parser
$xml = simplexml_load_string($primeGridAccount) or die('Error: Cannot create object');

if (!empty($xml->active_task_set) && !empty($xml->active_task_set->active_task)) {
	foreach ($xml->active_task_set->active_task as $task) {?>
		<div class="card">
			<div class="card-header text-white bg-primary mb-3"><?=$task->result_name;?></div>
			<div class="card-body">
				<div class="card-title">Status: <?=($task->active_task_state) ? "Active" : "Inactive";?></div>
				<div class="card-body">
						<p class="lead">Checkpoint Fraction Done: <span class="h2 text-success"><?=round($task->checkpoint_fraction_done * 100, 2);?>%</span></p>
						<p class="lead">App Version Number: <?=$task->app_version_num;?></p>
						<p class="lead">Checkpoint CPU Time: <?=$task->checkpoint_cpu_time;?></p>
						<p class="lead">Checkpoint Elapsed Time: <?=$task->checkpoint_elapsed_time;?></p>
						<p class="lead">Checkpoint Fraction Done Elapsed Time: <?=$task->checkpoint_fraction_done_elapsed_time;?></p>
						<p class="lead">Current CPU Time: <?=$task->current_cpu_time;?></p>
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

<?php include 'footer.php';?>