<?php
require_once 'vendor/autoload.php';

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

        $mongoLink = $envVariables['MONGO_CONNECT_LINK'];

        try {
            $client = new MongoDB\Client($mongoLink);
            echo "Conexão com o MongoDB estabelecida com sucesso! <br>";
            return $client;
        } catch (Exception $e) {
            echo "Erro ao conectar ao MongoDB: " . $e->getMessage() . "<br>";
            return null;
        }
    }


    public static function CreateCollection($dbName, $collectionName)
    {
        try {
            $client = self::Connect();
            if ($client) {
                $database = $client->selectDatabase($dbName);
                $collection = $database->createCollection($collectionName);
                echo "Coleção '$collectionName' criada com sucesso no banco de dados '$dbName'.<br>";
                return $collection;
            } else {
                echo "Não foi possível criar a coleção. Falha na conexão com o MongoDB.<br>";
                return null;
            }
        } catch (Exception $e) {
            echo "Erro ao criar coleção: " . $e->getMessage() . "<br>";
            return null;
        }
    }
}
