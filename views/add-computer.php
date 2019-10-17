<?php
    include '../header.php';
    if (!empty($_POST)) {
        $config = json_decode(file_get_contents('../config.json'), true);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $port = filter_var($_POST['port'], FILTER_SANITIZE_NUMBER_INT);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $config[$address]['address'] = $address;
        $config[$address]['port'] = $port;
        $config[$address]['password'] = $password;
        file_put_contents('../config.json', json_encode($config));
    }
?>
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="card-header">Add Computer Form</div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" placeholder="Address" required />
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" name="port" placeholder="Port" required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary btn-lg" value="Add Computer" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include '../footer.php';