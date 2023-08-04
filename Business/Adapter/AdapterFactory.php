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

namespace Micro\Plugin\FilesystemAdapter\Local\Business\Adapter;

use League\Flysystem\FilesystemAdapter;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;
use Micro\Plugin\FilesystemAdapter\Local\Configuration\Adapter\LocalAdapterConfigurationInterface;
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
        if (!($adapterConfiguration instanceof LocalAdapterConfigurationInterface)) {
            throw new \InvalidArgumentException(sprintf('Adapter configuration should be instance of %s.', LocalAdapterConfigurationInterface::class));
        }

        $additionalConfig = array_filter([
            'file' => $this->createAccessDataArray(
                $adapterConfiguration->getPermissionPublicFile(),
                $adapterConfiguration->getPermissionPrivateFile()
            ),
            'dir' => $this->createAccessDataArray(
                $adapterConfiguration->getPermissionPublicDirectory(),
                $adapterConfiguration->getPermissionPrivateDirectory(),
            ),
        ]);

        $additionalConfig = !empty($additionalConfig) ?
            PortableVisibilityConverter::fromArray($additionalConfig) :
            null;

        return new LocalFilesystemAdapter(
            $adapterConfiguration->getRootDirectory(),
            $additionalConfig,
            $adapterConfiguration->getWriteFlags(),
            $adapterConfiguration->getLinkHeading(),
            null,
            $adapterConfiguration->isLazyRootCreation(),
        );
    }

    /**
     * @param int $public
     * @param int $private
     *
     * @return array<string|int>
     */
    protected function createAccessDataArray(int $public, int $private): array
    {
        return array_filter([
            'public' => $public,
            'private' => $private,
        ]);
    }
}
