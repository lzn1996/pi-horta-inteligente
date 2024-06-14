<?php
class SQLConnection
{
    public static function Connect()
    {
        $envFile = file('../.env');
        $envVariables = [];

        foreach ($envFile as $line) {
            $parts = explode('=', $line, 2);
            if (count($parts) == 2) { // Ensure that both key and value are present
                list($key, $value) = $parts;
                $envVariables[trim($key)] = trim($value);
            }
        }

        $requiredEnvVars = ['SQL_DB_HOST', 'SQL_PORT', 'SQL_DB_NAME', 'SQL_DB_USERNAME'];
        foreach ($requiredEnvVars as $var) {
            if (!isset($envVariables[$var]) || empty($envVariables[$var])) {
                throw new Exception("Variável de ambiente '$var' não está definida ou é vazia.");
            }
        }

        $dsn = 'mysql:host=' . $envVariables['SQL_DB_HOST'] . ';port=' . $envVariables['SQL_PORT'] . ';dbname=' . $envVariables['SQL_DB_NAME'];

        try {
            $pdo = new PDO($dsn, $envVariables['SQL_DB_USERNAME']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            error_log('Erro ao conectar ao banco de dados: ' . $e->getMessage());
            return null;
        }
    }
}
