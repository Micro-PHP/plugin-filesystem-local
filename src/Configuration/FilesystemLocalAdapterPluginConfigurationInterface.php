<?php

namespace Micro\Plugin\Filesystem\Adapter\Local\Configuration;

use Micro\Plugin\Filesystem\Configuration\FilesystemPluginConfigurationInterface;

interface FilesystemLocalAdapterPluginConfigurationInterface extends FilesystemPluginConfigurationInterface
{
    public const ADAPTER_NAME = 'local';
}