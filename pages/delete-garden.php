<?php
require_once "../model/Garden.php";

$id = $_GET['garden-id'];

Garden::delete($id);

$base_url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$base_url .= "://" . $_SERVER['HTTP_HOST'];
$redirect_url = $base_url . "/pi-horta-inteligente/pages/criar-jardim.php";

header("Location: $redirect_url");
