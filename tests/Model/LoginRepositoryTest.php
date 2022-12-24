<?php

declare(strict_types=1);

namespace AppTest\Model;

use App\Model\LoginRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use App\SQL\SqlConnection;
use PHPUnit\Framework\TestCase;

class LoginRepositoryTest extends TestCase
{
    private LoginRepository $loginRepository;

    protected function setUp(): void
    {
        $container = $this->getContainer();
        $pdo = new \PDO('mysql:host=0.0.0.0:13306;dbname=shopix', 'TestUser', 'password');
        $this->loginRepository = new LoginRepository($container->get(SqlConnection::class), $pdo);
        parent::setUp();
    }
    protected function tearDown(): void
    {
        unset($this->loginRepository);
        parent::tearDown();
    }

    public function testIfAdminDataIsFound(): void
    {
        $adminArrayFromDb = $this->loginRepository->findAdminByName('admin');
        $paramsThatDbShouldDeliver = [
            'AdminId' => 1,
            0 => 1,
            'userName' => 'admin',
            1 => 'admin',
            'hashedPassword' => '$2y$10$znTFHBIvM4dnDjxnHJs/gu/uulO//BxQMO8GsZE92TA5XHFXBnF4u',
            2 => '$2y$10$znTFHBIvM4dnDjxnHJs/gu/uulO//BxQMO8GsZE92TA5XHFXBnF4u',
        ];

        self::assertCount(6, $adminArrayFromDb);
        self::assertSame($paramsThatDbShouldDeliver, $adminArrayFromDb);
    }

    public function testIfUserDataIsFound(): void
    {
        $adminArrayFromDb = $this->loginRepository->findUserByName('UserTest123');
        $paramsThatDbShouldDeliver = [
            'id' => 2,
            0 => 2,
            'userName' => 'UserTest123',
            1 => 'UserTest123',
            'firstName' => 'testi1',
            2 => 'testi1',
            'lastName' => 'user1',
            3 => 'user1',
            'country' => 'testaa',
            4 => 'testaa',
            'postcode' => '12345',
            5 => '12345',
            'city' => 'Hamburrch',
            6 => 'Hamburrch',
            'street' => 'teststreet',
            7 => 'teststreet',
            'streetNumber' => '99',
            8 => '99',
            'email' => 'test@testmail.test',
            9 => 'test@testmail.test',
            'telefonNumber' => '01234567891',
            10 => '01234567891',
            'hashedPassword' => '$2y$10$KHRC2ZGpNz1V1H5YMuOmAuOS0szm8OVyZL/1k8YFH2tnBwYqQuzSm',
            11 => '$2y$10$KHRC2ZGpNz1V1H5YMuOmAuOS0szm8OVyZL/1k8YFH2tnBwYqQuzSm',
        ];

        self::assertCount(24, $adminArrayFromDb);
        self::assertSame($paramsThatDbShouldDeliver, $adminArrayFromDb);
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
