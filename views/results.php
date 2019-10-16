<?php
    include '../header.php'; ?>
    <div class="container">
        <div class="row">
            <div class="card-columns">
                <?php
                    $rpc = new RPC($address, $port, $password);
                    $state = trim($rpc->get_results(), "\u0003^\003");
                    $xml = simplexml_load_string($state) or die('Error: Cannot create object');
                    echo "<pre>";
                    print_r($xml);
                    echo "</pre>";
                    exit;
                    if (!empty($xml->results) && !empty($xml->results->result)) {
                        foreach ($xml->results->result as $result) { ?>
                            <div class="card">
                                <div class="card-header text-white bg-primary mb-3"><?= $result->name; ?></div>
                                <div class="card-body">
                                    <div class="card-title">Report Deadline: <?= date('Y-m-d', (int)$result->report_deadline); ?></div>
                                    <div class="card-body">
                                        <p class="lead">Checkpoint Fraction Done:
                                            <span class="h2 text-success"><?= round((float)$result->active_task->fraction_done * 100, 2); ?>%</span>
                                        </p>
                                        <p class="lead">App Version Number: <?= $result->version_num; ?></p>
                                        <p class="lead">Plan Class: <?= $result->plan_class; ?></p>
                                        <p class="lead">Received Time: <?= date('Y-m-d', (int)$result->received_time); ?></p>
                                        <p class="lead">Current CPU Time: <?= $result->active_task->current_cpu_time; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                ?>
            </div>
        </div>
    </div>
<?php include '../footer.php';