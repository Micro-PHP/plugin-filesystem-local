<?php

declare(strict_types=1);

/*
 *  This file is part of the Micro framework package.
 *
 *  (c) Stanislau Komar <kost@micro-php.net>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Micro\Plugin\FilesystemAdapter\Local;

use Micro\Framework\DependencyInjection\Container;
use Micro\Framework\BootConfiguration\Plugin\ConfigurableInterface;
use Micro\Framework\BootDependency\Plugin\DependencyProviderInterface;
use Micro\Framework\BootConfiguration\Plugin\PluginConfigurationTrait;
use Micro\Framework\BootPluginDependent\Plugin\PluginDependedInterface;
use Micro\Plugin\FilesystemAdapter\Local\Business\Adapter\AdapterFactory;
use Micro\Plugin\FilesystemAdapter\Local\Configuration\FilesystemLocalAdapterPluginConfigurationInterface;
use Micro\Plugin\FilesystemAdapter\Local\Decorator\LocalFilesystemFacadeDecorator;
use Micro\Plugin\Filesystem\Business\Adapter\AdapterFactoryInterface;
use Micro\Plugin\Filesystem\Business\FS\FsFactory;
use Micro\Plugin\Filesystem\Business\FS\FsFactoryInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
use Micro\Plugin\Filesystem\FilesystemPlugin;

/**
 * @method FilesystemLocalAdapterPluginConfigurationInterface configuration()
 */
class FilesystemLocalAdapterPlugin implements DependencyProviderInterface, ConfigurableInterface, PluginDependedInterface
{
    use PluginConfigurationTrait;

    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $container->decorate(FilesystemFacadeInterface::class, function (
            FilesystemFacadeInterface $filesystemFacade
        ): FilesystemFacadeInterface {
            return $this->createFacadeDecorator($filesystemFacade);
        });
    }

    public function getDependedPlugins(): iterable
    {
        return [
            FilesystemPlugin::class,
        ];
    }

    /**
     * @return FsFactoryInterface
     */
    protected function createFsFactory(): FsFactoryInterface
    {
        return new FsFactory(
            $this->configuration(),
            $this->createAdapterFactory()
        );
    }

    /**
     * @return AdapterFactoryInterface
     */
    protected function createAdapterFactory(): AdapterFactoryInterface
    {
        return new AdapterFactory();
    }

    /**
     * @param FilesystemFacadeInterface $filesystemFacade
     *
     * @return FilesystemFacadeInterface
     */
    protected function createFacadeDecorator(FilesystemFacadeInterface $filesystemFacade): FilesystemFacadeInterface
    {
        return new LocalFilesystemFacadeDecorator(
            $filesystemFacade,
            $this->createFsFactory(),
            $this->configuration()
        );
    }
}
