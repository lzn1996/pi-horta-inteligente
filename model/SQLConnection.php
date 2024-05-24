<?php
class SQLConnection
{
    public static function Connect()
    {
        $envFile = file('./.env');
        $envVariables = [];

        foreach ($envFile as $line) {
            list($key, $value) = explode('=', $line, 2);
            $envVariables[trim($key)] = trim($value);
        }



        $dsn = 'mysql:host=' . $envVariables['SQL_DB_HOST'] . ';port=' . $envVariables['SQL_PORT'] . ';dbname=' . $envVariables['SQL_DB_NAME'];

        try {
            $pdo = new PDO($dsn, $envVariables['SQL_DB_USERNAME'], $envVariables['SQL_DB_PASS']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Conexão com o banco de dados SQL estabelecida com sucesso! <br>";
            return $pdo;
        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage() . "<br>";
            return null;
        }
    }
}
