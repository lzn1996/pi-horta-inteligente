<?php

require '../model/Garden.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $plantName = $_POST['plantName'] ?? null;
    $plantType = $_POST['plantType'] ?? null;
    $plantDescription = $_POST['plantDescription'] ?? null;
    $newPlantImage = $_FILES['plantImage'] ?? null;

    $success = Garden::update($id, $plantName, $plantType, $plantDescription, $newPlantImage);

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