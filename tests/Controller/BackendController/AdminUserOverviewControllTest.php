<?php

declare(strict_types=1);

namespace AppTest\Controller\BackendController;

use App\Controller\BackendController\AdminProductOverviewControll;
use App\Controller\BackendController\AdminUserOverviewControll;
use App\Core\View;
use App\Model\Dto\UserDataTransferObject;
use App\Model\ProductRepository;
use App\Model\UserRepository;
use App\Service\Container;
use App\Service\DependencyProvider;
use PHPUnit\Framework\TestCase;

class AdminUserOverviewControllTest extends TestCase
{
    protected function tearDown(): void
    {
        $_SESSION = [];
        $_POST = [];
        parent::tearDown();
    }

    public function testIfArrayIsSetUp(): void
    {
        $_GET['userId'] = '1';
        $_POST['submit'] = true;
        $container = $this->getContainer();
        /** @var View $view */
        $view = $container->get(View::class);
        $mockUserRepository = $this->createMock(UserRepository::class);
        $mockUserRepository->expects($this->once())->method('deleteUserById');
        $mockUserRepository->expects($this->once())->method('getAllUsers')->willReturn(
            [new UserDataTransferObject(1,'user', 'user', 'user', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test'), new UserDataTransferObject(2,'user', 'user', 'user', 'test', 'test', 'test', 'test', 'test', 'test', 'test', 'test')]);
        $adminUserOverviewControll = new AdminUserOverviewControll($view, $mockUserRepository);

        $adminUserOverviewControll->renderView();
        $params = $view->getParams();
        $template = $view->getTemplate();
        $expectedArray = ['userDisplay' => [1 => 'user', 2 => 'user']];

        self::assertSame($expectedArray, $params);
        self::assertIsArray($params);
        self::assertCount(1, $params);
        self::assertSame('userOverview.tpl',$template);
    }


    private function getContainer(): Container
    {
        $container = new Container();
        $dependencyProvider = new DependencyProvider();
        $dependencyProvider->providerDependency($container);
        return $container;
    }
}
