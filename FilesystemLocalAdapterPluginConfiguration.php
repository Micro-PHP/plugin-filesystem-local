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

use Micro\Plugin\FilesystemAdapter\Local\Configuration\Adapter\LocalAdapterConfiguration;
use Micro\Plugin\FilesystemAdapter\Local\Configuration\FilesystemLocalAdapterPluginConfigurationInterface;
use Micro\Plugin\Filesystem\Configuration\Adapter\FilesystemAdapterConfigurationInterface;
use Micro\Plugin\Filesystem\FilesystemPluginConfiguration;

class FilesystemLocalAdapterPluginConfiguration extends FilesystemPluginConfiguration implements FilesystemLocalAdapterPluginConfigurationInterface
{
    public function getAdapterConfiguration(string $adapterName): FilesystemAdapterConfigurationInterface
    {
        return new LocalAdapterConfiguration($this->configuration, $adapterName);
    }
}
