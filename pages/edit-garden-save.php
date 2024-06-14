<?php

require '../model/Garden.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        $updateParams = ['id' => $id];

        if (isset($_POST['plantName'])) {
            $updateParams['plantName'] = $_POST['plantName'];
        }
        if (isset($_POST['plantType'])) {
            $updateParams['plantType'] = $_POST['plantType'];
        }
        if (isset($_POST['plantDescription'])) {
            $updateParams['plantDescription'] = $_POST['plantDescription'];
        }
        if ($_FILES['plantImage']['error'] === UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["plantImage"]["tmp_name"];
            $fileName = basename($_FILES["plantImage"]["name"]);
            move_uploaded_file($tmp_name, "../uploads/$fileName");

            $updateParams['plantImage'] = $fileName;
        }

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
