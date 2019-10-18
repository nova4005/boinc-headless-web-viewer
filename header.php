<?php
    include 'env.php';
    include 'src/RPC.php';
    include 'src/AccountManager.php';
    include 'src/helpers.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Boinc Headless Viewer</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="/bootstrap.min.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/views/">Boinc Headless Viewer</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?= get_active_class('index.php'); ?>">
                        <a class="nav-link" href="/">Tasks</a>
                    </li>
                    <li class="nav-item  <?= get_active_class('results.php'); ?>">
                        <a class="nav-link" href="/views/results.php">Results</a>
                    </li>
                    <li class="nav-item  <?= get_active_class('add-computer.php'); ?>">
                        <a class="nav-link" href="/views/add-computer.php">Add Computer</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <p class="display-4">Boinc Headless Viewer</p>
                <p class="lead">This web app will show you information about the boinc client running on your computer/server.</p>
            </div>

            <div class="container">
                <div class="row">
                    <div class="lead">Choose Computer</div>
                </div>
                <div class="row">
                        <?= list_computers(); ?>
                </div>
            </div>
        </div>