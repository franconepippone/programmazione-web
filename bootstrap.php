<?php

require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/config/config.php');

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;;

/**
 * Resistuisce un instanza di EntityManager, connessa al database configurato in config.php.
 */
function getEntityManager() : EntityManager
{
    $entityManager = null;

    if ($entityManager === null)
    {

        # set up configuration parameters for doctrine.
        # Make sure you have installed the php7.0-sqlite package.
        $connectionParams = array(
            'dbname' => DB_NAME,
            'user' => DB_USER,
            'password' => DB_PASS,
            'host' => DB_HOST,
            'driver' => 'pdo_mysql',
        );
        
        // percorso alla cartella con le classi entità
        $paths = [__DIR__."/sportZone/entity"];
        $isDevMode = false;
        
        $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);

        $config->setProxyDir(__DIR__ . '/proxies');
        $config->setProxyNamespace('Proxies');
        $config->setAutoGenerateProxyClasses(true);

        $connection = DriverManager::getConnection($connectionParams, $config);
        $entityManager = new EntityManager($connection, $config);
    }

    return $entityManager;
}