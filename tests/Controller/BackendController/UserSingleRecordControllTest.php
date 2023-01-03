<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\UserSingleRecordControll;
use App\Core\View;
use App\Model\Dto\UserDataTransferObject;
use App\Model\UserRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;


class UserSingleRecordControllTest extends TestCase
{
    protected function setUp(): void
    {
        $_SESSION['userId'] = 1;
        $_GET['userId'] = '1';
        $_POST['submit'] = true;
        $_POST['Username'] = 'UserForTest';
        $_POST['First_Name'] = 'User';
        $_POST['Last_Name'] = 'ForTest';
        $_POST['Country'] = 'TestCountry';
        $_POST['Postcode'] = '55555';
        $_POST['City'] = 'TestCity';
        $_POST['Street'] = 'TestStreet';
        $_POST['Streetnumber'] = '99';
        $_POST['E-Mail'] = 'test@test.test';
        $_POST['Telefonnumber'] = '0123456789';
        parent::setUp();
    }

    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIsFormSubmitted(): void
    {
        $container = $this->getContainer();
        $userDTO = new UserDataTransferObject(
            $_SESSION['userId'],
            $_POST['Username'],
            $_POST['First_Name'],
            $_POST['Last_Name'],
            $_POST['Country'],
            $_POST['Postcode'],
            $_POST['City'],
            $_POST['Street'],
            $_POST['Streetnumber'],
            $_POST['E-Mail'],
            $_POST['Telefonnumber'],
            ''
        );
        $mockRepository = $this->createMock(UserRepository::class);
        $mockRepository->expects($this->exactly(10))->method('editUserAttributeById');
        $mockRepository->expects($this->once())->method('getCurrentUserDataById')
            ->willReturn($userDTO);
        $userControll = new UserSingleRecordControll($view = $container->get(View::class), $mockRepository);
        $paramsThatShouldBeInArray = [
            'errors' => [],
            'userDataSet' => [
                'Username' => 'UserForTest',
                'First Name' => 'User',
                'Last Name' => 'ForTest',
                'Country' => 'TestCountry',
                'Postcode' => '55555',
                'City' => 'TestCity',
                'Street' => 'TestStreet',
                'Streetnumber' => '99',
                'E-Mail' => 'test@test.test',
                'Telefonnumber' => '0123456789',
            ],
        ];

        $userControll->renderView();
        $template = $view->getTemplate();
        $params = $view->getParams();

        self::assertSame('userSingleRecord.tpl', $template);
        self::assertSame($paramsThatShouldBeInArray, $params);
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}