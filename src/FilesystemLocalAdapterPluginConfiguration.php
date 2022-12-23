<?php

namespace Micro\Plugin\Filesystem\Adapter\Local;

use Micro\Plugin\Filesystem\Adapter\Local\Configuration\Adapter\LocalAdapterConfiguration;
use Micro\Plugin\Filesystem\Adapter\Local\Configuration\FilesystemLocalAdapterPluginConfigurationInterface;
use Micro\Plugin\Filesystem\Configuration\Adapter\FilesystemAdapterConfigurationInterface;
use Micro\Plugin\Filesystem\FilesystemPluginConfiguration;

class FilesystemLocalAdapterPluginConfiguration extends FilesystemPluginConfiguration implements FilesystemLocalAdapterPluginConfigurationInterface
{
    public function getAdapterConfiguration(string $adapterName): FilesystemAdapterConfigurationInterface
    {
        return new LocalAdapterConfiguration($this->configuration, $adapterName);
    }
}