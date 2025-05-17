<?php

require_once __DIR__ . "/../bootstrap.php";
require_once __DIR__. "/../sportZone/entity/EentityA_test.php";
require_once __DIR__. "/../sportZone/entity/EentityB_test.php";


$entityManager = getEntityManager();

$new_entity = new EntityA();
$new_entity->setProperty1(4);
$new_entity->setProperty2("ciccioBello");


$new_entity->addEntityB( new EntityB("pierino"));
$new_entity->addEntityB( new EntityB("alfredo"));


print_r($new_entity);


$entityManager->persist($new_entity);
$entityManager->flush();