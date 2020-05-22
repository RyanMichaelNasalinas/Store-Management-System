<?php
require_once 'init/init.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $loginUser = $user->loginUser($username, $password);

    if (empty($username) && empty($password)) {
        echo "Username or Password should not be empty";
    } else if (empty($username)) {
        echo "Username should be empty";
    } else if (empty($password)) {
        echo "Password should not be empty";
    } else if ($loginUser) {
        Helper::redirect('index.php');
    } else if ($loginUser == false) {
        echo "Username or Password is incorrect";
    } else {
        echo "User Does not exist";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Helper::getTitle(); ?></title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <form action="" method="post">
                <div class="form-input">
                    <label>Username</label>
                    <input type="text" name="username" id="username" value="<?= isset($username) ? $username : '' ?>">
                </div>
                <div class="form-input">
                    <label>Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="form-input">
                    <button type="submit" name="login">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>