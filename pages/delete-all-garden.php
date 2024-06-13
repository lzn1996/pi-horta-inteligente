<?php
require_once "../model/Garden.php";

Garden::deleteAll();

header('Location: ../pages/criar-jardim.php');
