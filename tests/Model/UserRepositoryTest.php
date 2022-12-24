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

/**
 * @infection-ignore-all
 */
class UserRepositoryTest extends TestCase
{
    private int $userId = 0;
    private Container $container;
    protected function setUp(): void
    {
        $this->container = $this->getContainer();
        $userRepository = new UserRepository($this->container->get(SqlConnection::class), $this->container->get(UserDataMapper::class));
        $userArray = $userRepository->getAllUsers();
        foreach ($userArray as $user){
            if($user->userName === 'newUser') {
                $this->userId = $user->id;
            }
        }

        parent::setUp();
    }
    protected function tearDown(): void
    {
        unset($this->userRepository);
        parent::tearDown();
    }

    public function testIfUserDataIsFound(): void
    {
        $userRepository = new UserRepository($this->container->get(SqlConnection::class), $this->container->get(UserDataMapper::class));
        $givenArray = $userRepository->getAllUsers();

        $paramsThatDbShouldDeliver = [0 => new UserDataTransferObject(1, 'UserForTest', 'User','ForTest', 'TestCountry', '55555', 'TestCity', 'TestStreet', '99', 'test@test.test', '0123456789', ' '),
            1 => new UserDataTransferObject(2, 'UserTest123', 'testi1','user1', 'testaa', '12345', 'Hamburrch', 'teststreet', '99', 'test@testmail.test', '01234567891', '$2y$10$KHRC2ZGpNz1V1H5YMuOmAuOS0szm8OVyZL/1k8YFH2tnBwYqQuzSm'),
            2 => new UserDataTransferObject(3, 'Jonathan.Hemmerling', 'Jonathan','Hemmerling', 'Test', '44444', 'Test', 'Test', '66', 'Test', '0123456789', '$2y$10$mjcpfV5JV91vhcMEVYunS.CmY/.XBCW0.G0SEzsBwlSjZI6sh6G5e'),
            3 => new UserDataTransferObject(4, 'MasterOTUniverse', 'Master','OTUniverse', 'Space', '00001', 'Universe', 'Unistreet', '99', 'otuniverse@master.space', '999999999', '$2y$10$0kfEc5faY6XXCWU6ah7RkutdJtlhhOErDUHEiuRlii4sJqk3DGS.G'),
            ];

        self::assertEquals($paramsThatDbShouldDeliver, $givenArray);
    }

    public function testIfCurrentUserDataIsFound(): void
    {
        $userRepository = new UserRepository($this->container->get(SqlConnection::class), $this->container->get(UserDataMapper::class));
        $givenObject = $userRepository->getCurrentUserDataById(2);
        $paramsThatDbShouldDeliver = new UserDataTransferObject(2, 'UserTest123', 'testi1','user1', 'testaa', '12345', 'Hamburrch', 'teststreet', '99', 'test@testmail.test', '01234567891', '$2y$10$KHRC2ZGpNz1V1H5YMuOmAuOS0szm8OVyZL/1k8YFH2tnBwYqQuzSm');
        self::assertSame('UserTest123', $givenObject->userName);
        self::assertEquals($paramsThatDbShouldDeliver, $givenObject);
    }

    public function testIfCurrentUserExists(): void
    {
        $userRepository = new UserRepository($this->container->get(SqlConnection::class), $this->container->get(UserDataMapper::class));
        $user = $userRepository->doesUserDataExists('UserTest123');
        $noUser = $userRepository->doesUserDataExists('User');
        self::assertTrue($user);
        self::assertFalse($noUser);
    }

    public function testIfNewUserIsCreatedEditedAndDeleted(): void
    {
        $userRepository = new UserRepository($this->container->get(SqlConnection::class), $this->container->get(UserDataMapper::class));
        $userDataSet = ['userName'=> 'newUser', 'firstName' =>'new', 'lastName' =>'User', 'country' =>'Test', 'postCode' => 'Test', 'city' => 'Test', 'street' => 'Test', 'streetNumber' =>'Test', 'email' =>'Test', 'telefonNumber' =>'Test', 'hashedPassword' =>''];
        $userRepository->addNewUserDataArrayToDb($userDataSet);
        $userArray = $userRepository->getAllUsers();
        $userId = 0;
        foreach ($userArray as $user){
            if($user->userName === 'newUser') {
                $userId = $user->id;
            }
        }
        $createdNewUser = $userRepository->getCurrentUserDataById($userId);
        $userRepository->editUserAttributeById($userId, 'lastName', 'editedUser');
        $editedUser = $userRepository->getCurrentUserDataById($userId);
        $userRepository->deleteUserById($userId);
        $deleted = $userRepository->getCurrentUserDataById($userId);

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
