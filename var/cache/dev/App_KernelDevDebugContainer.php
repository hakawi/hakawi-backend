<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerHCxjkzm\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerHCxjkzm/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerHCxjkzm.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerHCxjkzm\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerHCxjkzm\App_KernelDevDebugContainer([
    'container.build_hash' => 'HCxjkzm',
    'container.build_id' => '3a52baa0',
    'container.build_time' => 1631673974,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerHCxjkzm');
