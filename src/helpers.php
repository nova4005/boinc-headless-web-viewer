<?php

    function get_active_class($page = 'index.php')
    {
        $document = explode('/', $_SERVER['DOCUMENT_URI']);
        return (end($document) == $page) ? 'active' : '';
    }

    function list_computers()
    {
        $config = json_decode(file_get_contents('../config.json'), true);

        if (!empty($config) && is_array($config)) {
            $output = '';
            foreach ($config as $computer) {
                $output .= "<div class=\"card\"><a class=\"card-body btn btn-lg btn-outline-success\" href='http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . "/?address=" . $computer['address'] . "'>" . $computer['address'] . "</a></div>";
            }
            return $output;
        }
        return false;
    }