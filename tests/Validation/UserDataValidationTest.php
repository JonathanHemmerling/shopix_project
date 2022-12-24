<?php

declare(strict_types=1);

namespace AppTest\Validation;

use App\Model\LoginRepository;
use App\Model\UserRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use App\Validation\UserDataValidation;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;



class UserDataValidationTest extends TestCase
{
    private UserDataValidation $userDataValidation;
    private MockObject $userRepository;
    private MockObject $loginRepository;
    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this>$this->loginRepository = $this->createMock(LoginRepository::class);
        $this->userDataValidation = new UserDataValidation($this->loginRepository, $this->userRepository);
        parent::setUp();
    }

    protected function tearDown(): void
    {
        unset($this->userDataValidation);
        parent::tearDown();
    }

    public function testIfNewUserNameIsValid(): void
    {
        $userIsValid = $this->userDataValidation->checkIfNewUserNameIsValid('UserName');
        $userIsBlank = $this->userDataValidation->checkIfNewUserNameIsValid('');
        $userNameHasTheRightLengthLow = $this->userDataValidation->checkIfNewUserNameIsValid('Its');
        $userNameHasTheRightLengthHigh = $this->userDataValidation->checkIfNewUserNameIsValid('12345678901234567890');
        $userNameIsToShort = $this->userDataValidation->checkIfNewUserNameIsValid('It');
        $userNameIsToLong = $this->userDataValidation->checkIfNewUserNameIsValid('123456789012345678901');
        $this->userRepository->expects($this->once())->method('doesUserDataExists')->willReturn(true);
        $userNameExists = $this->userDataValidation->checkIfNewUserNameIsValid('XYZV');

        self::assertTrue($userIsValid);
        self::assertFalse($userIsBlank);
        self::assertTrue($userNameHasTheRightLengthLow);
        self::assertTrue($userNameHasTheRightLengthHigh);
        self::assertFalse($userNameIsToShort);
        self::assertFalse($userNameIsToLong);
        self::assertFalse($userNameExists);
    }
    public function testIfUserNameIsValid(): void
    {
        $this->loginRepository->expects($this->atLeastOnce())->method('findAdminByName')->willReturn(['userName'=>'AdminName']);
        $userIsValid = $this->userDataValidation->checkIfUserNameIsValid('AdminName');
        $userIsBlank = $this->userDataValidation->checkIfUserNameIsValid('');
        $userNameIsToShort = $this->userDataValidation->checkIfUserNameIsValid('It');
        $userNameIsToLong = $this->userDataValidation->checkIfUserNameIsValid('1234567890ASDFGHJKLÖÄ123456');

        self::assertTrue($userIsValid);
        self::assertFalse($userIsBlank);
        self::assertFalse($userNameIsToShort);
        self::assertFalse($userNameIsToLong);
    }

    public function testIfPasswordIsValid(): void
    {
        $passwordIsValid = $this->userDataValidation->checkIfPasswordIsValid('$2y$10$KHRC2ZGpNz1V1H5YMuOmAuOS0szm8OVyZL/1k8YFH2tnBwYqQuzSm', 'password');
        $passwordIsNotHashed = $this->userDataValidation->checkIfPasswordIsValid('password', 'password');
        $passwordBothBlank = $this->userDataValidation->checkIfPasswordIsValid('','');
        $passwordIsBlank = $this->userDataValidation->checkIfPasswordIsValid('', 'password');
        $confirmPasswordIsBlank = $this->userDataValidation->checkIfPasswordIsValid('password', '');
        $passwordIsToShort = $this->userDataValidation->checkIfPasswordIsValid('password','passwor');
        $passwordIsValidForValidatePassword = $this->userDataValidation->verifyPassword('password','$2y$10$KHRC2ZGpNz1V1H5YMuOmAuOS0szm8OVyZL/1k8YFH2tnBwYqQuzSm');
        $passwordIsNotHashedForValidatePassword = $this->userDataValidation->verifyPassword('password', 'password');

        self::assertTrue($passwordIsValid);
        self::assertFalse($passwordIsNotHashed);
        self::assertFalse($passwordBothBlank);
        self::assertFalse($passwordIsBlank);
        self::assertFalse($passwordIsToShort);
        self::assertFalse($confirmPasswordIsBlank);
        self::assertFalse($passwordIsToShort);
        self::assertTrue($passwordIsValidForValidatePassword);
        self::assertFalse($passwordIsNotHashedForValidatePassword);
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
