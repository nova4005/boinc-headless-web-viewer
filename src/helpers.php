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
                $output .= "<div class=\"card\"><div class=\"card-body btn btn-lg btn-outline-success\" data-address='" . $computer['address'] . "'>" . $computer['address'] . "</div></div>";
            }
            return $output;
        }
        return false;
    }