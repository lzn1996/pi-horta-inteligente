<?php

require '../model/Garden.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // Array para armazenar os parâmetros de atualização
        $updateParams = ['id' => $id];

        // Verifica se o nome da planta foi enviado e adiciona aos parâmetros de atualização
        if (isset($_POST['plantName'])) {
            $updateParams['plantName'] = $_POST['plantName'];
        }
        // Verifica se o tipo de planta foi enviado e adiciona aos parâmetros de atualização
        if (isset($_POST['plantType'])) {
            $updateParams['plantType'] = $_POST['plantType'];
        }

        // Verifica se a umidade do solo foi enviada e adiciona aos parâmetros de atualização
        if (isset($_POST['soilMoisture'])) {
            $updateParams['soilMoisture'] = $_POST['soilMoisture'];
        }
        // Verifica se a data de plantio foi enviada e adiciona aos parâmetros de atualização
        if (isset($_POST['plantingDate'])) {
            $updateParams['plantingDate'] = $_POST['plantingDate'];
        }
        // Verifica se a data de colheita foi enviada e adiciona aos parâmetros de atualização
        if (isset($_POST['harvestDate'])) {
            $updateParams['harvestDate'] = $_POST['harvestDate'];
        }
        // Verifica se notas adicionais foram enviadas e adiciona aos parâmetros de atualização
        if (isset($_POST['additionalNotes'])) {
            $updateParams['additionalNotes'] = $_POST['additionalNotes'];
        }
        // Verifica se uma nova imagem da planta foi enviada e a move para a pasta de uploads
        if ($_FILES['plantImage']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["plantImage"]["tmp_name"];
            $fileName = basename($_FILES["plantImage"]["name"]);
            move_uploaded_file($tmp_name, "../uploads/$fileName");

            $updateParams['plantImage'] = $fileName;
        }

        // Chama o método estático update da classe Garden para realizar a atualização
        $success = Garden::update(
            $updateParams['id'],
            $updateParams['plantName'] ?? null,
            $updateParams['plantType'] ?? null,
            $updateParams['soilMoisture'] ?? null,
            $updateParams['plantingDate'] ?? null,
            $updateParams['harvestDate'] ?? null,
            $updateParams['additionalNotes'] ?? null,
            $updateParams['plantImage'] ?? null
        );

        // Verifica se a atualização foi bem-sucedida e redireciona conforme necessário
        if ($success) {
            header("Location: ../pages/criar-jardim.php");
            exit();
        } else {
            header("Location: ../pages/erro.php");
            exit();
        }
    } else {
        // Caso o ID não seja enviado, redireciona para a página de erro
        header("Location: ../pages/erro.php");
        exit();
    }
} else {
    // Se o método de requisição não for POST, redireciona para a página de criação de jardim
    header("Location: ../pages/criar-jardim.php");
    exit();
}
