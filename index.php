<?php
require_once __DIR__ . "/config/config.php";
require_once __DIR__ . "/sportZone/controllers/CFrontController.php";
require_once __DIR__ . "/bootstrap.php";
/*
$entityManager = getEntityManager();
$cl = $entityManager->find(EReservation::class, 1);
echo $cl->getDate()->format('Y-m-d H:i:s');
echo "<br>EntityManager loaded successfully.<br>";
*/
$fc = new CFrontController();
$fc->run($_SERVER['REQUEST_URI']);