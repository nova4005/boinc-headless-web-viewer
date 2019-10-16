<?php

    function get_active_class($page = 'index.php')
    {
        $document = explode('/', $_SERVER['DOCUMENT_URI']);
        return (end($document) == $page) ? 'active' : '';
    }