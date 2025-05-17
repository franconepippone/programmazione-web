<?php

require_once __DIR__ . "/../bootstrap.php";
require_once __DIR__. "/../sportZone/entity/EentityA_test.php";
require_once __DIR__. "/../sportZone/entity/EentityB_test.php";


$entityManager = getEntityManager();


$entity = $entityManager->find(EntityA::class, 2);

echo $entity->getId() . " " . $entity->getProperty1() ." ". $entity->getProperty2();

$entity->setProperty1($entity->getProperty1() + 1);

$entityManager->flush();