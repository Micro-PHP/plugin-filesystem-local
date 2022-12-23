<?php

namespace Micro\Plugin\Filesystem\Adapter\Local;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\ConfigurableInterface;
use Micro\Framework\Kernel\Plugin\DependencyProviderInterface;
use Micro\Framework\Kernel\Plugin\PluginConfigurationTrait;
use Micro\Plugin\Filesystem\Adapter\Local\Business\Adapter\AdapterFactory;
use Micro\Plugin\Filesystem\Adapter\Local\Configuration\FilesystemLocalAdapterPluginConfigurationInterface;
use Micro\Plugin\Filesystem\Adapter\Local\Decorator\LocalFilesystemFacadeDecorator;
use Micro\Plugin\Filesystem\Business\Adapter\AdapterFactoryInterface;
use Micro\Plugin\Filesystem\Business\FS\FsFactory;
use Micro\Plugin\Filesystem\Business\FS\FsFactoryInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;

/**
 * @method FilesystemLocalAdapterPluginConfigurationInterface configuration()
 */
class FilesystemLocalAdapterPlugin implements DependencyProviderInterface, ConfigurableInterface
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