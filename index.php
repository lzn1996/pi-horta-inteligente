<?php

require "./model/MongoConnection.php";


// MongoConnection::Connect();
// MongoConnection::CreateCollection('smartgarden', 'local');
$failedInAuthenticationErrorMessage = '';

if (isset($_GET['user-invalid']) && $_GET['user-invalid'] === 'true') {
    $failedInAuthenticationErrorMessage = "Usuário ou senha inválidos. Por favor, digite corretamente.";
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="index.js" defer></script>
</head>

<body>
    <div class="form-container" style='min-width: 300px' ;>
        <h2 class="text-center mb-4">Login</h2>
        <?php if (!empty($failedInAuthenticationErrorMessage)) : ?>
            <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
                <?php echo $failedInAuthenticationErrorMessage; ?>
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Fechar">
                </button>

            </div>
        <?php endif; ?>
        <form id="loginForm" method="post" action='./pages/check-user.php'>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Seu e-mail" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" placeholder="Sua senha" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
            <div class="mt-3 d-flex justify-content-between">
                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#createAccountModal">Crie sua conta</button>
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
                    <form id="createAccountForm" method="POST" action="./pages/user-save.php">
                        <div class="mb-3">
                            <label for="newName" class="form-label">Nome</label>
                            <input type="name" class="form-control" id="newName" placeholder="Digite seu nome" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="newEmail" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="newEmail" placeholder="Digite seu e-mail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="newPassword" placeholder="Digite sua senha" name="password">
                            <p id='errorMessage' style='color: red;'></p>
                        </div>
                        <div class="mb-3">
                            <label for="confirmNewPassword" class="form-label">Confirmar senha</label>
                            <input type="password" class="form-control" id="confirmNewPassword" placeholder="Confirme a sua senha">
                            <p id="confirmMessage" style='color: red;'></p>
                        </div>
                        <button type="submit" id="createAccBtn" class="btn btn-light w-100" disabled>Criar conta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>