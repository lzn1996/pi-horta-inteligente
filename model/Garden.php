<?php

require_once '../model/SQLConnection.php';
require_once '../model/Sensor.php';

class Garden
{
    private $plantName;
    private $plantType;
    private $plantDescription;
    private $plantImage;
    private $id;

    public function __construct($plantName, $plantType, $plantDescription, $plantImage)
    {
        $this->id = uniqid();
        $this->plantName = $plantName;
        $this->plantType = $plantType;
        $this->plantDescription = $plantDescription;
        $this->plantImage = $plantImage;
    }

    public function create()
    {
        try {
            $conexao = SQLConnection::connect();

            $stmt = $conexao->prepare("INSERT INTO garden (id, plant_name, plant_type, plant_description, plant_image) VALUES (:id, :plantName, :plantType, :plantDescription, :plantImage)");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':plantName', $this->plantName);
            $stmt->bindParam(':plantType', $this->plantType);
            $stmt->bindParam(':plantDescription', $this->plantDescription);
            $stmt->bindParam(':plantImage', $this->plantImage);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $sensor = new Sensor();
                if ($sensor->create($this->id)) {
                    return true;
                }
            }
        } catch (PDOException $e) {
            echo "Erro ao salvar no banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public static function getAll()
    {
        try {
            $conexao = SQLConnection::connect();

            $stmt = $conexao->prepare("SELECT * FROM garden");
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao obter jardins do banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public static function delete($id)
    {
        try {
            $conexao = SQLConnection::connect();

            $stmt = $conexao->prepare("DELETE FROM garden WHERE id = :id");
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Erro ao excluir jardim do banco de dados: " . $e->getMessage();
            return false;
        }
    }


    public static function count()
    {
        try {
            $conexao = SQLConnection::connect();

            $stmt = $conexao->prepare("SELECT COUNT(*) as total FROM garden");
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (PDOException $e) {
            echo "Erro ao contar registros no banco de dados: " . $e->getMessage();
            return false;
        }
    }


    public static function deleteAll()
    {
        try {
            $conexao = SQLConnection::connect();

            $stmt = $conexao->prepare("DELETE FROM garden");

            $stmt->execute();
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Erro ao excluir jardim do banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public static function getById($id)
    {
        try {
            $conexao = SQLConnection::connect();

            $stmt = $conexao->prepare("SELECT * FROM garden WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro ao obter jardim do banco de dados: " . $e->getMessage();
            return false;
        }
    }

    public static function update($id, $plantName = null, $plantType = null, $plantDescription = null, $newPlantImage = null)
    {
        try {
            $conexao = SQLConnection::connect();

            $sql = "UPDATE garden SET ";

            $params = array();
            if ($plantName !== null) {
                $sql .= "plant_name = :plantName, ";
                $params[':plantName'] = $plantName;
            }
            if ($plantType !== null) {
                $sql .= "plant_type = :plantType, ";
                $params[':plantType'] = $plantType;
            }
            if ($plantDescription !== null) {
                $sql .= "plant_description = :plantDescription, ";
                $params[':plantDescription'] = $plantDescription;
            }
            if ($newPlantImage !== null) {
                $tmp_name = $newPlantImage["tmp_name"];
                $fileName = basename($newPlantImage["name"]);
                move_uploaded_file($tmp_name, "../uploads/$fileName");

                $sql .= "plant_image = :plantImage, ";
                $params[':plantImage'] = $fileName;
            }

            $sql = rtrim($sql, ", ");

            $sql .= " WHERE id = :id";
            $params[':id'] = $id;

            $stmt = $conexao->prepare($sql);
            $stmt->execute($params);

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            echo "Erro ao atualizar jardim no banco de dados: " . $e->getMessage();
            return false;
        }
    }
}
