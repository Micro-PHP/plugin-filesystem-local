<?php

namespace Micro\Plugin\Filesystem\Adapter\Local\Business\Adapter;

use League\Flysystem\FilesystemAdapter;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;
use Micro\Plugin\Filesystem\Business\Adapter\AdapterFactoryInterface;
use Micro\Plugin\Filesystem\Configuration\Adapter\FilesystemAdapterConfigurationInterface;

class AdapterFactory implements AdapterFactoryInterface
{
    /**
     * @param FilesystemAdapterConfigurationInterface $adapterConfiguration
     *
     * @return FilesystemAdapter
     */
    public function create(FilesystemAdapterConfigurationInterface $adapterConfiguration): FilesystemAdapter
    {
        return new LocalFilesystemAdapter(
            $adapterConfiguration->getRootDirectory(),
            PortableVisibilityConverter::fromArray([
                'file' => [
                    'public' => $adapterConfiguration->getPermissionPublicFile(),
                    'private' => $adapterConfiguration->getPermissionPrivateFile(),
                ],
                'dir' => [
                    'public' => $adapterConfiguration->getPermissionPublicDirectory(),
                    'private' => $adapterConfiguration->getPermissionPrivateDirectory(),
                ],
            ]),
            $adapterConfiguration->getWriteFlags(),
            $adapterConfiguration->getLinkHeading(),
            null,
            $adapterConfiguration->isLazyRootCreation(),
        );
    }
}