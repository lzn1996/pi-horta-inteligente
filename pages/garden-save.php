<?php

require '../model/Garden.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['plantName']) && isset($_POST['plantType']) && isset($_POST['plantDescription']) && isset($_FILES['plantImage'])) {
        $plantName = $_POST['plantName'];
        $plantType = $_POST['plantType'];
        $soil_moisture = $_POST['soil_moisture'];
        $planting_date = $_POST['planting_date'];
        $harvest_date = $_POST['harvest_date'];
        $additional_notes = $_POST['additional_notes'];


        if ($_FILES['plantImage']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["plantImage"]["tmp_name"];
            $fileName = basename($_FILES["plantImage"]["name"]);
            move_uploaded_file($tmp_name, "../uploads/$fileName");

            $garden = new Garden($plantName, $plantType, $fileName, $soil_moisture, $planting_date, $harvest_date, $additional_notes);
            $userId = $_SESSION['user_id']['id'];
            $success = $garden->create($userId);

            if ($success) {
                $queryString = http_build_query(['garden-created-success' => 'true']);
                $redirectUrl = '../pages/criar-jardim.php?' . $queryString;
                header('Location: ' . $redirectUrl);
                exit();
            } else {
                $error_message = urlencode("Erro ao salvar no banco de dados.");
                $queryString = http_build_query(['garden-created-error' => 'true', 'error_message' => $error_message]);
                $redirectUrl = '../pages/criar-jardim.php?' . $queryString;
                header('Location: ' . $redirectUrl);
                exit();
            }
        } else {
            $error_message = urlencode("Erro ao fazer o upload da imagem.");
            $queryString = http_build_query(['garden-created-error' => $error_message]);
            $redirectUrl = '../pages/criar-jardim.php?' . $queryString;
            header('Location: ' . $redirectUrl);
            exit();
        }
    } else {
        $error_message = urlencode("Falta de parâmetros no formulário.");
        $queryString = http_build_query(['garden-created-error' => $error_message]);
        $redirectUrl = '../pages/criar-jardim.php?' . $queryString;
        header('Location: ' . $redirectUrl);
        exit();
    }
} else {
    header("Location: ../pages/criar-jardim.php");
    exit();
}
