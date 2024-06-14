<?php
require './authenticate-user.php';
require '../model/User.php';


$password = '';
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $email = $_POST['email'];
}
if (!empty($password) && !empty($email)) {
    $isUserAlreadyExists = authenticate($email, $password);
    if ($isUserAlreadyExists) {
        session_start();
        $_SESSION['user_email'] = $email;
        $_SESSION['user_id'] = User::getUserId($email);
        header('Location: ../pages/criar-jardim.php');
        exit();
    } else {
        $queryString = http_build_query(['user-invalid' => 'true']);
        $redirectUrl = '../index.php?' . $queryString;
        header('Location: ' . $redirectUrl);
        exit();
    }
}
