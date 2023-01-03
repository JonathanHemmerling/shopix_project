<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\CreateUserControll;
use App\Core\View;
use App\Model\LoginRepository;
use App\Model\UserRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use App\Validation\UserDataValidation;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CreateUserControllTest extends TestCase
{
    private UserDataValidation $userDataValidation;
    private MockObject $userRepository;
    private View $view;

    protected function setUp(): void
    {
        $_POST['submit'] = true;
        $_POST['userName'] = 'test';
        $_POST['firstName'] = 'test';
        $_POST['lastName'] = 'test';
        $_POST['country'] = 'test';
        $_POST['postCode'] = 'test';
        $_POST['city'] = 'test';
        $_POST['street'] = 'test';
        $_POST['streetNumber'] = 'test';
        $_POST['email'] = 'test';
        $_POST['password'] = 'password';
        $_POST['confirmPassword'] = '';
        $_POST['telefonNumber'] = 'test';
        $container = $this->getContainer();
        $this->userRepository = $this->createMock(UserRepository::class);
        $loginRepository = $this->createMock(LoginRepository::class);
        $this->view = $container->get(View::class);
        $this->userDataValidation = new UserDataValidation($loginRepository, $this->userRepository);
        parent::setUp();
    }
    protected function tearDown(): void
    {
        unset($this->userDataValidation);
        $_POST = [];
        parent::tearDown();
    }

    public function testIfUserIsNotAdded(): void
    {
        $mockRepository = $this->createMock(UserRepository::class);
        $mockRepository->expects($this->never())->method('addNewUserDataArrayToDb');
        $productSingleRecordControll = new CreateUserControll($this->view, $mockRepository, $this->userDataValidation);

        $productSingleRecordControll->renderView();
        $params = $this->view->getParams();
        $template = $this->view->getTemplate();


        self::assertCount(1, $params);
        self::assertSame('createUser.tpl', $template);
    }
    public function testIfUserIsAdded(): void
    {
        $_POST['submit'] = true;
        $_POST['userName'] = 'test';
        $_POST['firstName'] = 'test';
        $_POST['lastName'] = 'test';
        $_POST['country'] = 'test';
        $_POST['postCode'] = 'test';
        $_POST['city'] = 'test';
        $_POST['street'] = 'test';
        $_POST['streetNumber'] = 'test';
        $_POST['email'] = 'test';
        $_POST['password'] = 'password';
        $_POST['confirmPassword'] = 'test';
        $_POST['telefonNumber'] = 'test';

        $mockValidation = $this->createMock(UserDataValidation::class);
        $mockValidation->expects($this->once())->method('checkIfNewUserNameIsValid')->with('test')->willReturn(true);
        $mockValidation->expects($this->once())->method('checkIfPasswordIsValid')->willReturn(true);
        $mockRepository = $this->createMock(UserRepository::class);
        $mockRepository->expects($this->once())->method('addNewUserDataArrayToDb');
        $productSingleRecordControll = new CreateUserControll($this->view, $mockRepository, $mockValidation);
        $paramsThatShouldBeInArray = ['errors' => []];

        $productSingleRecordControll->renderView();
        $params = $this->view->getParams();
        $template = $this->view->getTemplate();

        self::assertSame($paramsThatShouldBeInArray, $params);
        self::assertCount(1, $params);
        self::assertSame('createUser.tpl', $template);
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

    public function testIfPasswordIsValid(): void
    {
        $passwordIsValid = $this->userDataValidation->checkIfPasswordIsValid('$2y$10$KHRC2ZGpNz1V1H5YMuOmAuOS0szm8OVyZL/1k8YFH2tnBwYqQuzSm', 'password');
        $passwordIsNotHashed = $this->userDataValidation->checkIfPasswordIsValid('password', 'password');
        $passwordBothBlank = $this->userDataValidation->checkIfPasswordIsValid('','');
        $passwordIsBlank = $this->userDataValidation->checkIfPasswordIsValid('', 'password');
        $confirmPasswordIsBlank = $this->userDataValidation->checkIfPasswordIsValid('password', '');
        $passwordIsToShort = $this->userDataValidation->checkIfPasswordIsValid('$2y$10$KHRC2ZGpNz1V1H5YMuOmAuOS0szm8OVyZL/1k8YFH2tnBwYqQuzSm','passwor');
        $passwordHasTheRightLength = $this->userDataValidation->checkIfPasswordIsValid('$2y$10$KHRC2ZGpNz1V1H5YMuOmAuOS0szm8OVyZL/1k8YFH2tnBwYqQuzSm','password');
        $passwordIsValidForValidatePassword = $this->userDataValidation->verifyPassword('password','$2y$10$KHRC2ZGpNz1V1H5YMuOmAuOS0szm8OVyZL/1k8YFH2tnBwYqQuzSm');
        $passwordIsNotHashedForValidatePassword = $this->userDataValidation->verifyPassword('password', 'password');
        $passwordIsBlankWithEmptySpaces = $this->userDataValidation->checkIfPasswordIsValid('password', ' ');

        self::assertTrue($passwordIsValid);
        self::assertFalse($passwordIsNotHashed);
        self::assertFalse($passwordBothBlank);
        self::assertFalse($passwordIsBlank);
        self::assertFalse($confirmPasswordIsBlank);
        self::assertTrue($passwordHasTheRightLength);
        self::assertFalse($passwordIsToShort);
        self::assertTrue($passwordIsValidForValidatePassword);
        self::assertFalse($passwordIsNotHashedForValidatePassword);
        self::assertFalse($passwordIsBlankWithEmptySpaces);
    }


    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }

}
