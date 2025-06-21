<?php

/**
 * RUNNATE QUESTO FILE PER CREARE LE TABELLE SUL DATABASE AUTOMATICAMENTE, IN BASE AI COMMENTI ORM DEFINITI SULLE CLASSI ENTITY
 * Se da errore, molto probabilmente ci sono dei commenti #[ORM/...] sbagliati.
 * 
 * > php crea-schema-dp.php
 * > C:/xampp/php/php.exe crea-schema-dp.php
 */

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\DBAL\DriverManager;

require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/config/config.php');

// Setup paths to your entities
$paths = [__DIR__ . '/sportZone/entity'];
$isDevMode = true;

// Database connection info
$connectionParams = [
    'dbname' => DB_NAME,
    'user' => DB_USER,
    'password' => DB_PASS,
    'host' => DB_HOST,
    'driver' => 'pdo_mysql',
];

// Set up configuration and entity manager
$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($connectionParams, $config);
$entityManager = new EntityManager($connection, $config);


// Use SchemaTool to create/update schema
$schemaTool = new SchemaTool($entityManager);
$metadata = $entityManager->getMetadataFactory()->getAllMetadata();

if (empty($metadata)) {
    echo "No metadata found. Are your entity classes correct?\n";
    exit(1);
}

try {
    // Drops all tables for all entities in the current database
    $schemaTool->dropSchema($metadata);

    // Creates tables for all entities fresh
    $schemaTool->createSchema($metadata);

    echo "Schema dropped and recreated successfully.\n";
} catch (\Exception $e) {
    echo "Error during schema reset: " . $e->getMessage() . "\n";
}

// Create or update schema
try {
    $schemaTool->updateSchema($metadata);
    echo "Database schema successfully updated.\n";
} catch (\Exception $e) {
    echo "Error updating schema: " . $e->getMessage() . "\n";
}

$proxyFactory = $entityManager->getProxyFactory();
$proxyFactory->generateProxyClasses($entityManager->getMetadataFactory()->getAllMetadata());