<?php
require './init/init.php';
$user->logoutUser();
Helper::redirect("login-user.php");
