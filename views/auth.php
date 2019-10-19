<?php
include '../header.php';
$response = null;
if (!empty($_POST)) {
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $passwordConfirm = filter_var($_POST['password_confirm'], FILTER_SANITIZE_STRING);

    if ($password === $passwordConfirm) {
        //Save Password
        $config = json_decode(file_get_contents($configFile), true);
        $config['login_password'] = $password;
        file_put_contents($configFile, json_encode($config));
        // $response = '<div class="alert alert-success" role="alert">You have saved your authentication password.</div>';
        header('Location: /views/login.php');
        exit;
    } else {
        $response = '<div class="alert alert-danger" role="alert">Your passwords do not match.</div>';
    }
}



?>
<div class="container">
    <div class="row">
        <p class="display-4">Create Your Login Password</p>
    </div>
    <div class="row">
        <?= $response ?? ''; ?>
    </div>
    <div class="row">
        <form action="" method="post">
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password_confirm" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-block btn-primary" value="Save Password">
            </div>

        </form>
    </div>
</div>
<?php include '../footer.php';
