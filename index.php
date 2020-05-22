<?php
require_once 'init/init.php';
$user_data = $user->getSessionData();

if (!$user_data) {
    Helper::redirect("login-user.php");
}
?>

<?php require "inc/header.php"; ?>

<div>
    <p>Welcome <?= $user_data['full_name']; ?></p>
</div>


<?php require "inc/footer.php"; ?>