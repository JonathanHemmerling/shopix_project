<?php

declare(strict_types=1);

use App\Entity\UserData;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use \App\Controller\BackendController\UserDataController;

require_once __DIR__ . '/bootstap.php';

$paths = [__DIR__ . '/src'];

$connection = DriverManager::getConnection([
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => 'password',
    'dbname' => 'shopix',
]);

$UDC = new UserDataController();
$UDC->createNewUser();

//$entityManager = new EntityManager($connection, );


/*$newProductName = $argv[1];

$user = new UserData();
$user->setId($newProductName);

$entityManager->persist($user);
$entityManager->flush();

echo "Created Product with ID " . $user->getId();*/
