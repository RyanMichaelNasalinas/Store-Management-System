<?php require 'init/init.php'; ?>

<?php

require "inc/header.php";

$user_data = $user->getSessionData();

if (!$user_data) {
    redirect("login-user.php");
    exit;
}

?>

<?php require 'inc/navigation.php'; ?>

<div>
    <p>Welcome <?= $user_data['username']; ?></p>
</div>


<?php require "inc/footer.php"; ?>