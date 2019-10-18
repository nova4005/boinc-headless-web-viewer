<?php
include '../header.php'; ?>
<div class="container">
    <div class="row">

        <?php
        $rpc = new RPC($_SESSION['address'], $_SESSION['port'], $_SESSION['password']);
        $state = trim($rpc->get_results(), "\u0003^\003");
        $xml = simplexml_load_string($state) or die('Error: Cannot create object');
        // echo "<pre>";
        // print_r(json_decode(json_encode($xml->results), true));
        // echo "</pre>";
        // exit;
        $results = json_decode(json_encode($xml->results), true);
        // echo "<pre>";
        // print_r($results['result']);
        // echo "</pre>";
        // exit;
        if (!empty($results)) {
            usort($results['result'], 'sorted_results_by_fraction_done');
            foreach ($results['result'] as $result) {
                if (!empty($result['active_task'])) { ?>
                    <div class="col-lg-4 mt-4">
                        <div class="card">
                            <div class="card-header text-white bg-primary mb-3"><?= $result['name']; ?></div>
                            <div class="card-body">
                                <div class="card-title">Report Deadline: <?= date('Y-m-d', (int) $result['report_deadline']); ?></div>
                                <div class="card-body">
                                    <p class="lead">Checkpoint Fraction Done:
                                        <span class="h2 text-success"><?= round(((float) $result['active_task']['fraction_done'] * 100), 2); ?>%</span>
                                    </p>
                                    <p class="lead">App Version Number: <?= $result['version_num']; ?></p>
                                    <p class="lead">Received Time: <?= date('Y-m-d', (int) $result['received_time']); ?></p>
                                    <p class="lead">Current CPU Time: <?= $result['active_task']['current_cpu_time']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php }
                }
            }
            ?>
                    </div>
    </div>
    <?php include '../footer.php';
