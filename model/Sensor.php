<?php

require_once 'SQLConnection.php';

class Sensor
{
    private $id;
    private $garden_id;

    public function create($garden_id)
    {
        $this->id = uniqid();

        try {
            $conn = SQLConnection::Connect();
            $stmt = $conn->prepare("INSERT INTO sensor (id, garden_id) VALUES (:id, :garden_id)");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':garden_id', $garden_id);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo "Erro ao criar o sensor: " . $e->getMessage();
            return false;
        }
    }
}
