<?php
require "../model/User.php";

$successMsg = '';
$errorMsg = '';

$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];

$user = new User($name, $password, $email);
$isRegisterAttemptOk = $user->save();

if ($isRegisterAttemptOk) {
    $successMsg = 'Usuário cadastrado com sucesso!';
    $errorMsg = '';
} else {
    $errorMsg = 'Já existe um usuário cadastrado com esse email.';
    $successMsg = '';
}
