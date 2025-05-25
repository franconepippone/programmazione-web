<?php

require_once __DIR__ . "/../../sportZone/foundation/FEntityManager.php";
foreach (glob(__DIR__ . "/../../sportZone/entity/E*.php") as $file) {
    require_once $file;
}

$fem = FEntityManager::getInstance();

$campo = new ECampo();
$campo->setNumero(2);
$campo->setCoperto(false);
$campo->setCosto(2.50);
$campo->setSport("padel");
$campo->setTipologiaTerreno("boh");

echo "salvando...\n";
$fem->saveObject($campo);
echo "Oggetto salvato\n";

$campo_retr = $fem->retriveObj(ECampo::class, 1);
echo "oggetto recuperato, id: ". $campo_retr->getId();
echo $campo_retr->getCosto();