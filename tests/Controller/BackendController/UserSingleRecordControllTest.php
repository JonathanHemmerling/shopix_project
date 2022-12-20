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
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIsFormSubmitted(): void
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

        $container = $this->getContainer();
        /** @var View $view */
        $view = $container->get(View::class);
        $userDTO = new UserDataTransferObject(1, 'UserForTest', "User", "ForTest", "TestCountry", '55555', 'TestCity', 'TestStreet', '99', 'test@test.test', "0123456789", '');
        $mockRepository = $this->createMock(UserRepository::class);
        $mockRepository->expects($this->exactly(10))->method('editUserAttributeById');
        $mockRepository->expects($this->once())->method('getCurrentUserDataById')
            ->willReturn($userDTO);
        $userControll = new UserSingleRecordControll($view, $mockRepository);

        $userControll->renderView();
        $template = $view->getTemplate();
        $params = $view->getParams();
        $expectedArray = ['changedUser' => [], 'errors' => [],
            'items' => ['Username' => 'UserForTest', 'First Name' => 'User', 'Last Name' => 'ForTest', 'Country' => 'TestCountry', 'Postcode' => '55555', 'City' => 'TestCity', 'Street' => 'TestStreet', 'Streetnumber' => '99', 'E-Mail' => 'test@test.test', 'Telefonnumber' => '0123456789']];

        self::assertSame('userSingleRecord.tpl' ,$template);
        self::assertIsArray($params);
        self::assertSame($expectedArray,$params);


    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}