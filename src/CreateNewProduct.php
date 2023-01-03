<?php

declare(strict_types=1);
namespace App;

require_once "bootstap.php";
require_once  __DIR__."/Products.php";

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$paths = array(__DIR__);
$isDevMode = false;
$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode, null,null, false);

// configuring the database connection
$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'host' => '0.0.0.0',
    'port' => '13360',
    'database' =>' shopix',
    'user' => 'TestUser',
    'password' =>'password',
], $config);

// obtaining the entity manager
$entityManager = new EntityManager($connection, $config);


$newProductName = $argv[0];

$product = new Products();

var_dump($product);

$product->setDisplayName($newProductName);
$entityManager->persist($product);
$entityManager->flush();

echo $product->getProductId();