<?php

declare(strict_types=1);

namespace AppTest\Model;

use App\Model\Dto\UserDataTransferObject;
use App\Model\Mapper\UserDataMapper;
use App\Model\UserRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use App\SQL\SqlConnection;
use PHPUnit\Framework\TestCase;


class UserRepositoryTest extends TestCase
{
    private int $userId = 0;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $container = $this->getContainer();
        $this->userRepository = new UserRepository(
            $container->get(SqlConnection::class),
            $container->get(UserDataMapper::class)
        );
        parent::setUp();
    }

    protected function tearDown(): void
    {
        $this->userRepository->deleteUserById($this->userId);
        unset($this->userRepository);
        parent::tearDown();
    }

    public function testIfAllUserDataIsFound(): void
    {
        $paramsThatDbShouldDeliver = [
            0 => new UserDataTransferObject(
                1,
                'UserForTest',
                'User',
                'ForTest',
                'TestCountry',
                '55555',
                'TestCity',
                'TestStreet',
                '99',
                'test@test.test',
                '0123456789',
                ' '
            ),
            1 => new UserDataTransferObject(
                2,
                'UserTest123',
                'testi1',
                'user1',
                'testaa',
                '12345',
                'Hamburrch',
                'teststreet',
                '99',
                'test@testmail.test',
                '01234567891',
                '$2y$10$KHRC2ZGpNz1V1H5YMuOmAuOS0szm8OVyZL/1k8YFH2tnBwYqQuzSm'
            ),
            2 => new UserDataTransferObject(
                3,
                'Jonathan.Hemmerling',
                'Jonathan',
                'Hemmerling',
                'Test',
                '44444',
                'Test',
                'Test',
                '66',
                'Test',
                '0123456789',
                '$2y$10$mjcpfV5JV91vhcMEVYunS.CmY/.XBCW0.G0SEzsBwlSjZI6sh6G5e'
            ),
            3 => new UserDataTransferObject(
                4,
                'MasterOTUniverse',
                'Master',
                'OTUniverse',
                'Space',
                '00001',
                'Universe',
                'Unistreet',
                '99',
                'otuniverse@master.space',
                '999999999',
                '$2y$10$0kfEc5faY6XXCWU6ah7RkutdJtlhhOErDUHEiuRlii4sJqk3DGS.G'
            ),
        ];
        $dataArrayDeliveredByRepository = $this->userRepository->getAllUsers();

        self::assertEquals($paramsThatDbShouldDeliver, $dataArrayDeliveredByRepository);
    }

    public function testIfCurrentUserDataIsFound(): void
    {
        $dataObjectDeliveredByRepository = $this->userRepository->getCurrentUserDataById(2);
        $paramsThatDbShouldDeliver = new UserDataTransferObject(
            2,
            'UserTest123',
            'testi1',
            'user1',
            'testaa',
            '12345',
            'Hamburrch',
            'teststreet',
            '99',
            'test@testmail.test',
            '01234567891',
            '$2y$10$KHRC2ZGpNz1V1H5YMuOmAuOS0szm8OVyZL/1k8YFH2tnBwYqQuzSm'
        );

        self::assertSame('UserTest123', $dataObjectDeliveredByRepository->userName);
        self::assertEquals($paramsThatDbShouldDeliver, $dataObjectDeliveredByRepository);
    }

    public function testIfCurrentUserExists(): void
    {
        $isExistingUser = $this->userRepository->doesUserDataExists('UserTest123');
        $isNoExistingUser = $this->userRepository->doesUserDataExists('User');

        self::assertTrue($isExistingUser);
        self::assertFalse($isNoExistingUser);
    }

    public function testIfNewUserIsCreatedEditedAndDeleted(): void
    {
        $userDataSet = [
            'userName' => 'newUser',
            'firstName' => 'new',
            'lastName' => 'User',
            'country' => 'Test',
            'postCode' => 'Test',
            'city' => 'Test',
            'street' => 'Test',
            'streetNumber' => 'Test',
            'email' => 'Test',
            'telefonNumber' => 'Test',
            'hashedPassword' => '',
        ];

        $this->userRepository->addNewUserDataArrayToDb($userDataSet);
        $userArray = $this->userRepository->getAllUsers();
        foreach ($userArray as $user) {
            if ($user->userName === 'newUser') {
                $this->userId = $user->id;
            }
        }
        $createdNewUser = $this->userRepository->getCurrentUserDataById($this->userId);
        $this->userRepository->editUserAttributeById($this->userId, 'lastName', 'editedUser');
        $editedUser = $this->userRepository->getCurrentUserDataById($this->userId);
        $this->userRepository->deleteUserById($this->userId);
        $deleted = $this->userRepository->getCurrentUserDataById($this->userId);

        self::assertSame($createdNewUser->lastName, 'User');
        self::assertSame($editedUser->userName, 'newUser');
        self::assertNull($deleted);
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
