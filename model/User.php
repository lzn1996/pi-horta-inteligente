<?php
require "SQLConnection.php";
require "../vendor/autoload.php";

use Ramsey\Uuid\Uuid;

class User
{
    public $id;
    public $name;
    public $password;
    public $email;

    public function __construct($name, $password, $email)
    {
        $this->id = Uuid::uuid4();
        $this->name = strtolower(trim($name));
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            $this->email = NULL;
        }
    }

    public function save()
    {
        try {
            $conexao = SQLConnection::connect();
            if ($conexao === null) {
                error_log('Erro ao conectar ao banco de dados.');
                return false;
            }

            $stmt_check = $conexao->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt_check->bindParam(':email', $this->email);
            $stmt_check->execute();
            $result = $stmt_check->fetchColumn();

            if ($result > 0) {
                echo "O email fornecido já está em uso. Por favor, escolha outro email.";
                return false;
            }

            $stmt = $conexao->prepare("INSERT INTO users (user_id, name, password, email) VALUES (:id, :name, :email, :password)");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':email', $this->email);

            if ($stmt->execute()) {
                error_log('Usuário cadastrado com sucesso.');
                return true;
            } else {
                error_log('Erro ao salvar usuário no banco de dados.');
                return false;
            }
        } catch (PDOException $e) {
            error_log('Erro ao salvar usuário: ' . $e->getMessage());
            return false;
        }
    }
}
