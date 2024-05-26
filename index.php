<?php

// testando conexão
// require_once './model/SQLConnection.php';
// require_once './model/MongoConnection.php';
// SQLConnection::Connect();
// MongoConnection::Connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="form-container">
        <h2 class="text-center mb-4">Login</h2>
        <form>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <div class="mt-3 d-flex justify-content-between">
                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#createAccountModal">Crie sua conta</button>
                <button type="button" class="btn btn-link">Esqueceu sua senha?</button>
            </div>
        </form>
    </div>

    <!-- Inicio do modal "Criar conta" -->
    <div class="modal fade" id="createAccountModal" tabindex="-1" aria-labelledby="createAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAccountModalLabel">Crie sua conta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="newEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="newEmail" placeholder="Digite seu email">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="newPassword" placeholder="Digite sua senha">
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirmar senha</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confira sua senha">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Criar conta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>