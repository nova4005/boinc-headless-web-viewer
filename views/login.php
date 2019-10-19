<?php
include '../header.php';
$response = null;
if (!empty($_POST)) {
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $config = json_decode(file_get_contents($configFile), true);
    $passwordConfirm = $config['login_password'];

    if (!empty($passwordConfirm) && !empty($passwordConfirm) && $password === $passwordConfirm) {
        $_SESSION['logged_in'] = true;
        header('Location: /views/index.php');
        exit;
    } else {
        $response = '<div class="alert alert-danger" role="alert">Your passwords do not match.</div>';
    }
}



?>
<div class="container">
    <div class="row">
        <p class="display-4">Login</p>
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
                <input type="submit" class="btn btn-block btn-primary" value="Login">
            </div>

        </form>
    </div>
</div>
<?php include '../footer.php';
