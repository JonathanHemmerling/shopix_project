<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerKWx69IP\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerKWx69IP/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerKWx69IP.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerKWx69IP\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerKWx69IP\App_KernelDevDebugContainer([
    'container.build_hash' => 'KWx69IP',
    'container.build_id' => '650fe37f',
    'container.build_time' => 1672654491,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerKWx69IP');