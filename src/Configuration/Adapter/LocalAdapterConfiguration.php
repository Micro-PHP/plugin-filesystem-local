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

namespace Micro\Plugin\Filesystem\Adapter\Local\Configuration\Adapter;

use League\Flysystem\Local\LocalFilesystemAdapter;
use Micro\Framework\Kernel\Configuration\Exception\InvalidConfigurationException;
use Micro\Plugin\Filesystem\Configuration\Adapter\AbstractFilesystemAdapterConfiguration;

class LocalAdapterConfiguration extends AbstractFilesystemAdapterConfiguration implements LocalAdapterConfigurationInterface
{
    public const CFG_ROOT_DIRECTORY = 'MICRO_FS_%s_ROOT_PATH';
    public const CFG_LINKS_HANDLING = 'MICRO_FS_%s_LINK_HANDLING';
    public const CFG_WRITE_FLAGS = 'MICRO_FS_%s_WRITE_FLAGS';
    public const CFG_IS_LAZY_ROOT_CREATION = 'MICRO_FS_%s_LAZY_ROOT_CREATION';
    public const CFG_PERMISSION_FILE_PUBLIC = 'MICRO_FS_%s_PERMISSION_FILE_PUBLIC';
    public const CFG_PERMISSION_DIR_PUBLIC = 'MICRO_FS_%s_PERMISSION_DIR_PUBLIC';
    public const CFG_PERMISSION_FILE_PRIVATE = 'MICRO_FS_%s_PERMISSION_FILE_PRIVATE';
    public const CFG_PERMISSION_DIR_PRIVATE = 'MICRO_FS_%s_PERMISSION_DIR_PRIVATE';

    /**
     * {@inheritDoc}
     */
    public function getRootDirectory(): string
    {
        return $this->get(self::CFG_ROOT_DIRECTORY, null, false);
    }

    /**
     * {@inheritDoc}
     */
    public function getWriteFlags(): int
    {
        return (int) $this->get(self::CFG_WRITE_FLAGS);
    }

    /**
     * {@inheritDoc}
     */
    public function getLinkHeading(): int
    {
        $allowed = [
            LocalFilesystemAdapter::DISALLOW_LINKS,
            LocalFilesystemAdapter::SKIP_LINKS,
        ];

        $value = $this->get(self::CFG_LINKS_HANDLING, LocalFilesystemAdapter::DISALLOW_LINKS);

        $_value = (int) $value;
        if (\in_array($_value, $allowed)) {
            return $_value;
        }

        throw new InvalidConfigurationException(sprintf('Configuration key "%s" has invalid value `%s`. Allowed values: `%s`', $this->cfg(self::CFG_LINKS_HANDLING), (string) $value, implode(', ', $allowed)));
    }

    /**
     * {@inheritDoc}
     */
    public function isLazyRootCreation(): bool
    {
        return $this->get(self::CFG_IS_LAZY_ROOT_CREATION, false);
    }

    /**
     * {@inheritDoc}
     */
    public function getPermissionPublicFile(): int
    {
        return (int) $this->get(self::CFG_PERMISSION_FILE_PUBLIC, 0640);
    }

    /**
     * {@inheritDoc}
     */
    public function getPermissionPublicDirectory(): int
    {
        return (int) $this->get(self::CFG_PERMISSION_DIR_PUBLIC, 0604);
    }

    /**
     * {@inheritDoc}
     */
    public function getPermissionPrivateDirectory(): int
    {
        return (int) $this->get(self::CFG_PERMISSION_DIR_PRIVATE, 0740);
    }

    /**
     * {@inheritDoc}
     */
    public function getPermissionPrivateFile(): int
    {
        return (int) $this->get(self::CFG_PERMISSION_FILE_PRIVATE, 7604);
    }
}
