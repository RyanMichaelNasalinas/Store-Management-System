<?php
require_once 'init/init.php';
require '././helpers/helpers.php';

$user_data = $user->getSessionData();

if ($user_data != null) {
    redirect("index.php");
}

$errors = [];

if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $loginUser = $user->loginUser($username);

    if (isEmpty($username) && isEmpty($password)) {
        $errors[] = "Username and Password should be empty";
    } else {
        if (isEmpty($username)) {
            $errors[] = "Username should not be empty";
        }
        if (isEmpty($password)) {
            $errors[] = "Password should not be empty";
        }
    }

    // If error is empty
    if (empty($errors)) {
        if ($loginUser != null) {
            if (password_verify($password, $loginUser['password'])) {
                redirect('index.php');
            } else {
                $errors[] = "Username or Password is Incorrect";
            }
        } else {
            $errors[] = "User does not exists";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= getTitle(); ?></title>
</head>

<body>
    <div class="container">
        <?= displayError($errors); ?>
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