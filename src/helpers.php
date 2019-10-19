<?php

    function get_active_class($page = 'index.php')
    {
        $document = explode('/', $_SERVER['DOCUMENT_URI']);
        return (end($document) == $page) ? 'active' : '';
    }

    function list_computers()
    {
        $config = json_decode(file_get_contents($configFile), true);

        if (!empty($config['computers']) && is_array($config['computers'])) {
            $output = '';
            foreach ($config['computers'] as $computer) {
                $active = ($_SESSION['address'] === $computer['address']) ? 'btn-success' : 'btn-outline-success';
                $output .= "<a class='btn mr-2 " . $active . "' href='http://" . $_SERVER['SERVER_NAME'] . $_SERVER['SCRIPT_NAME'] . "/?address=" . $computer['address'] . "'>" . $computer['address'] . "</a>";
            }
            return $output;
        }
        return false;
    }

    function sorted_results_by_fraction_done($a, $b)
    {
        if(empty($a['active_task']) && !empty($b['active_task'])) {
            return 1;
        } else if(empty($b['active_task']) && !empty($a['active_task'])) {
            return -1;
        } else if(empty($b['active_task']) && empty($a['active_task'])) {
            return 0;
        }
        return $a['active_task']['fraction_done'] < $b['active_task']['fraction_done'] ? 1 : -1;
        // return strcmp($a['active_task']['fraction_done'], $b['active_task']['fraction_done']);
    }