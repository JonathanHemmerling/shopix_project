<?php

namespace Container4gF05iY;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getCache_AppService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'cache.app' shared service.
     *
     * @return \Symfony\Component\Cache\Adapter\FilesystemAdapter
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/psr/cache/src/CacheItemPoolInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/symfony/src/Symfony/Component/Cache/Adapter/AdapterInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/contracts/Cache/CacheInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/psr/log/src/LoggerAwareInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/symfony/src/Symfony/Component/Cache/ResettableInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/psr/log/src/LoggerAwareTrait.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/symfony/src/Symfony/Component/Cache/Traits/AbstractAdapterTrait.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/contracts/Cache/CacheTrait.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/symfony/src/Symfony/Component/Cache/Traits/ContractsTrait.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/symfony/src/Symfony/Component/Cache/Adapter/AbstractAdapter.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/symfony/src/Symfony/Component/Cache/PruneableInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/symfony/src/Symfony/Component/Cache/Traits/FilesystemCommonTrait.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/symfony/src/Symfony/Component/Cache/Traits/FilesystemTrait.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/symfony/src/Symfony/Component/Cache/Adapter/FilesystemAdapter.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/symfony/src/Symfony/Component/Cache/Marshaller/MarshallerInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/symfony/src/Symfony/Component/Cache/Marshaller/DefaultMarshaller.php';

        $container->services['cache.app'] = $instance = new \Symfony\Component\Cache\Adapter\FilesystemAdapter('vJ0cCFjpN+', 0, ($container->targetDir.''.'/pools/app'), new \Symfony\Component\Cache\Marshaller\DefaultMarshaller(NULL, true));

        $instance->setLogger(($container->privates['logger'] ?? $container->getLoggerService()));

        return $instance;
    }
}
