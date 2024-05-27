<?php
require "../model/User.php";

$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];

$user = new User($name, $password, $email);
$isRegisterAttemptOk = $user->save();

if ($isRegisterAttemptOk) {
    header("Location: ../index.php?success=true");
    exit();
} else {
    header("Location: ../index.php?success=false");
    exit();
}
