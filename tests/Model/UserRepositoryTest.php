<?php

declare(strict_types=1);

namespace AppTest\Model;

use App\Model\Mapper\UserDataMapper;
use App\Model\UserRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use App\SQL\SqlConnection;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{

    public function testIfUserDataIsFound(): void
    {
        $container = $this->getContainer();
        $repository = new UserRepository($container->get(SqlConnection::class), $container->get(UserDataMapper::class));

        $givenArray = $repository->getAllUsers();
        $expectedArray = [];

        self::assertCount(5, $givenArray);
        self::assertNotSame($expectedArray, $givenArray);
    }

    public function testIfCurrentUserDataIsFound(): void
    {
        $container = $this->getContainer();
        $repository = new UserRepository($container->get(SqlConnection::class), $container->get(UserDataMapper::class));

        $givenObject = $repository->getCurrentUserDataById(2);
        //$expectedArray = UserDataTransferObject::class &00000000000001280000000000000000['id' => 2, 'userName' => 'UserTest123', 'firstName' => 'testi1', 'lastName' => 'user1', 'country' => 'testaa', 'postcode' => '12345', 'city' => 'Hamburrch', 'street' => 'teststreet', 'streetNumber' => '99', 'email' => 'test@testmail.test', 'telefonNumber' => '01234567891', 'hashedPassword' => '$2y$10$KHRC2ZGpNz1V1H5YMuOmAuOS0szm8OVyZL/1k8YFH2tnBwYqQuzSm'];
        self::assertSame('UserTest123', $givenObject->userName);
        self::assertIsObject($givenObject);
        //self::assertSame($expectedArray, $givenObject);
    }

    public function testIfCurrentUserExists(): void
    {
        $container = $this->getContainer();
        $pdo = new \PDO('mysql:host=0.0.0.0:13306;dbname=shopix', 'TestUser', 'password');
        $repository = new UserRepository($container->get(SqlConnection::class), $container->get(UserDataMapper::class));

        $user = $repository->doesUserDataExists('UserTest123');
        $noUser = $repository->doesUserDataExists('User');

        self::assertTrue($user);
        self::assertFalse($noUser);
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
