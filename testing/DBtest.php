<?php

require_once(__DIR__."/../bootstrap.php");
require_once(__DIR__."/../sportZone/entity/entity_test.php");

$manager = getEntityManager();

$entity = new EntityTest();
$entity->setEmail("pierino2003@gmail.com");


$manager->persist($entity);
$manager->flush();


$entity2 = $manager->find(EntityTest::class, 27);


echo $entity2->getEmail();