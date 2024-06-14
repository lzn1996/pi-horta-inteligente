<?php
session_start();
session_unset();
session_destroy();


header("Location: /pi-horta-inteligente/index.php");
