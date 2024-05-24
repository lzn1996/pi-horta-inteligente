<?php
require 'vendor/autoload.php';

class MongoConnection
{
    public static function Connect()
    {
        $envFile = file('./.env');

        $envVariables = [];

        foreach ($envFile as $line) {
            list($key, $value) = explode('=', $line, 2);
            $envVariables[trim($key)] = trim($value);
        }

        $mongoUsername = $envVariables['MONGO_DB_USERNAME'];
        $mongoPassword = $envVariables['MONGO_DB_PASS'];

        try {
            $client = new MongoDB\Client("mongodb+srv://$mongoUsername:$mongoPassword@smartgarden.t53ywku.mongodb.net");
            echo "Conexão com o MongoDB estabelecida com sucesso! <br>";
            return $client;
        } catch (Exception $e) {
            echo "Erro ao conectar ao MongoDB: " . $e->getMessage() . "<br>";
            return null;
        }
    }
}
