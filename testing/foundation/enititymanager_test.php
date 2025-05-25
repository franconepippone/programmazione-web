<?php

require_once __DIR__ . "../../sportZone/foundation/FEntityManager.php";
require_once __DIR__ . "../../sportZone/entity/Ecampo.php";

$fem = FEntityManager::getInstance();

$campo = new ECampo();
$campo->setNumero(2)

$fem->retriveObj(ECampo::class, )