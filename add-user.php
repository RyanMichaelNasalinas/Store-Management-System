<?php require_once 'init/init.php'; ?>

<?php
require "inc/header.php";

$user_data = $user->getSessionData();

if (isset($user_data)) {
    $user_data['access'] != "admin" ? Helper::redirect("index.php") : '';
} else {
    Helper::redirect("login-user.php");
}
require "inc/navigation.php";

?>

<?php
if (isset($_POST['add_user'])) {
    $username = Helper::sanitizeField($_POST['username']);
    $email = Helper::sanitizeField($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $first_name = Helper::sanitizeField($_POST['first_name']);
    $last_name = Helper::sanitizeField($_POST['last_name']);

    if (empty($_POST['username'])) {
        echo "Username Should not be empty";
    } else if (empty($_POST['email'])) {
        echo "Email Should not be empty";
    } else if (empty($_POST['password'])) {
        echo "Password Should not be empty";
    } else if (empty($_POST['first_name'])) {
        echo "First Name Should not be empty";
    } else if (empty($_POST['last_name'])) {
        echo "Last Name Should not be empty";
    } else if ($user->checkUserExists('username', $username)) {
        echo "Username is already taken, pick another one";
    } else if ($user->checkUserExists('email', $email)) {
        echo "Email is already taken, pick another one";
    } else {
        $user->addUser($username, $email, $password, $first_name, $last_name);
        Helper::redirect('add-user.php');
    }
}
?>

<div class="container">
    <h1>Add New User</h1>
    <div class="form-container">
        <form action="" method="post">
            <div class="form-input">
                <label>Username</label>
                <input type="text" name="username" id="username" value="<?= isset($username) ? $username : '' ?>">
            </div>
            <div class="form-input">
                <label>Email</label>
                <input type="email" name="email" id="email" value="<?= isset($email) ? $email : '' ?>">
            </div>

            <div class="form-input">
                <label>Password</label>
                <input type="password" name="password" id="password">
            </div>

            <div class="form-input">
                <label>First Name</label>
                <input type="text" name="first_name" id="first_name" value="<?= isset($first_name) ? $first_name : '' ?>">
            </div>

            <div class="form-input">
                <label>Last Name</label>
                <input type="text" name="last_name" id="last_name" value="<?= isset($last_name) ? $last_name : '' ?>">
            </div>

            <div class="form-input">
                <button type="submit" name="add_user">Add User</button>
            </div>
        </form>
    </div>
</div>

<?php
require "inc/footer.php";
?>