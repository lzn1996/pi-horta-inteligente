<?php

require '../model/Garden.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se o ID está presente
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $updateParams = ['id' => $id];

        // Verifique e adicione os parâmetros fornecidos ao array
        if (isset($_POST['plantName'])) {
            $updateParams['plantName'] = $_POST['plantName'];
        }
        if (isset($_POST['plantType'])) {
            $updateParams['plantType'] = $_POST['plantType'];
        }
        if (isset($_POST['plantDescription'])) {
            $updateParams['plantDescription'] = $_POST['plantDescription'];
        }
        // Verifique se uma nova imagem foi enviada e adicione ao array
        if ($_FILES['plantImage']['error'] === UPLOAD_ERR_OK) {
            // Salve o arquivo de imagem e obtenha o nome do arquivo
            $tmp_name = $_FILES["plantImage"]["tmp_name"];
            $fileName = basename($_FILES["plantImage"]["name"]);
            move_uploaded_file($tmp_name, "../uploads/$fileName");

            // Adicione o nome do arquivo de imagem ao array de parâmetros
            $updateParams['plantImage'] = $fileName;
        }

        // Chame o método update com os parâmetros dinâmicos
        $success = Garden::update($id, $plantName, $plantType, $plantDescription, $_FILES['plantImage']);


        if ($success) {
            header("Location: ../pages/criar-jardim.php");
            exit();
        } else {
            header("Location: ../pages/erro.php");
            exit();
        }
    } else {

        header("Location: ../pages/erro.php");
        exit();
    }
} else {
    header("Location: ../pages/criar-jardim.php");
    exit();
}
