<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\CreateUserControll;
use App\Core\View;
use App\Model\UserRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use App\Validation\UserDataValidation;
use PHPUnit\Framework\TestCase;

class CreateUserControllTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfArrayIsSetUp(): void
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
        $_POST['password'] = '';
        $_POST['confirmPassword'] = '';
        $_POST['telefonNumber'] = 'test';

        $container = $this->getContainer();
        /** @var View $view */
        $view = $container->get(View::class);

        $mockValidation = $this->createMock(UserDataValidation::class);
        $mockValidation->expects($this->once())->method('checkIfNewUserNameIsValid')->with('test')->willReturn(true);
        $mockValidation->expects($this->once())->method('checkIfPasswordIsValid')->willReturn(true);
        $mockRepository = $this->createMock(UserRepository::class);
        $mockRepository->expects($this->once())->method('addNewUserDataArrayToDb');

        $productSingleRecordControll = new CreateUserControll($view, $mockRepository, $mockValidation);

        $productSingleRecordControll->renderView();
        var_dump($view->getParams());
        $params = $view->getParams();
        $template = $view->getTemplate();

        self::assertCount(1, $params);
        self::assertSame('createUser.tpl', $template);
    }

    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
