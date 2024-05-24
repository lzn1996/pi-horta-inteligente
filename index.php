<?php
require_once './model/SQLConnection.php';
require_once './model/MongoConnection.php';
SQLConnection::Connect();
MongoConnection::Connect();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="">
</head>

<body>
    <form action="login.php" method="post">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Entrar</button>
    </form>
    <a href="register.php">Registrar</a>
</body>

</html>