<?php

require '../model/Garden.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $plantName = $_POST['plantName'] ?? null;
    $plantType = $_POST['plantType'] ?? null;
    $plantDescription = $_POST['plantDescription'] ?? null;

    // Verifica se uma nova imagem foi enviada
    if ($_FILES['plantImage']['error'] === UPLOAD_ERR_OK) {
        $newPlantImage = $_FILES['plantImage'];

        // Se uma nova imagem foi enviada, usa a nova imagem
        $success = Garden::update($id, $plantName, $plantType, $plantDescription, $newPlantImage);
    } else {
        // Se nenhuma nova imagem foi enviada, mantém a imagem existente
        $success = Garden::update($id, $plantName, $plantType, $plantDescription);
    }

    var_dump($success);

    // if ($success) {
    //     header("Location: ../pages/criar-jardim.php");
    //     exit();
    // } else {
    //     header("Location: ../pages/erro1.php");
    //     exit();
    // }
} else {
    header("Location: ../pages/erro2.php");
    exit();
}
