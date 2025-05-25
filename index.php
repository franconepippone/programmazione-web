<?php
require_once __DIR__ . "/config/config.php";
require_once __DIR__ . "/sportZone/controllers/CFrontController.php";

$fc = new CFrontController();
$fc->run($_SERVER['REQUEST_URI']);