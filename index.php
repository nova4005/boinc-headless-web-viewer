<?php include 'header.php'; ?>


<?php
// $rpc = new RPC('192.168.1.103', '31416', $password);
// $auth = $rpc->authenticate();
$acctMgr = new AccountManager($address, $port, $password);
$info = $acctMgr->get_account_manager_info();

echo "<pre>";
print_r($info);
echo "</pre>";
exit;



// $socket = socket_create(AF_INET, SOCK_STREAM, 0);
// $address = '192.168.1.103';
// $connect = socket_connect($socket, $address, '31416');

// // $command = "<get_results>
//     // <active_only></active_only>
// // </get_results>";

// $command = "<auth1/>";
// $request = "<boinc_gui_rpc_request>$command</boinc_gui_rpc_request>\003";
// $send = socket_write($socket, $request);

// $nonce = socket_read($socket, 4096);
// $nonce = filter_var($nonce, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

// // echo "<pre>";
// // var_dump($nonce);
// // echo "</pre>";


// //Create auth hash
// $password = "craps-commend-gaiety-faerie-chapbook";
// $key = strtolower(md5($nonce . $password));
// echo $key . "<br>";
// $authCommand = "<auth2><nonce_hash>$key</nonce_hash></auth2>";
// $authRequest = "<boinc_gui_rpc_request>$authCommand</boinc_gui_rpc_request>\003";
// $auth = socket_write($socket, $authRequest);
// $authRead = socket_read($socket, 4096);





// $authCommand = "<get_all_projects_list/>";
// $authRequest = "<boinc_gui_rpc_request>$authCommand</boinc_gui_rpc_request>\003";
// $auth = socket_write($socket, $authRequest);
// $authRead = socket_read($socket, 4096);




// echo "<pre>";
// print_r($authRead);
// echo "</pre>";
// exit;
?>


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
				foreach ($xml->active_task_set->active_task as $task) { ?>
					<div class="card">
						<div class="card-header text-white bg-primary mb-3"><?= $task->result_name; ?></div>
						<div class="card-body">
							<div class="card-title">Status: <?= ($task->active_task_state) ? "Active" : "Inactive"; ?></div>
							<div class="card-body">
								<p class="lead">Checkpoint Fraction Done: <span class="h2 text-success"><?= round($task->checkpoint_fraction_done * 100, 2); ?>%</span></p>
								<p class="lead">App Version Number: <?= $task->app_version_num; ?></p>
								<p class="lead">Checkpoint CPU Time: <?= $task->checkpoint_cpu_time; ?></p>
								<p class="lead">Checkpoint Elapsed Time: <?= $task->checkpoint_elapsed_time; ?></p>
								<p class="lead">Checkpoint Fraction Done Elapsed Time: <?= $task->checkpoint_fraction_done_elapsed_time; ?></p>
								<p class="lead">Current CPU Time: <?= $task->current_cpu_time; ?></p>
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

<?php include 'footer.php'; ?>