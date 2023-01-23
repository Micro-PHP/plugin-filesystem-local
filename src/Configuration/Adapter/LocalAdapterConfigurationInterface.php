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

use Micro\Plugin\Filesystem\Configuration\Adapter\FilesystemAdapterConfigurationInterface;

interface LocalAdapterConfigurationInterface extends FilesystemAdapterConfigurationInterface
{
    /**
     * @return string
     */
    public function getRootDirectory(): string;

    /**
     * @return int
     */
    public function getWriteFlags(): int;

    /**
     * @return int
     */
    public function getLinkHeading(): int;

    /**
     * @return bool
     */
    public function isLazyRootCreation(): bool;

    /**
     * @return int
     */
    public function getPermissionPublicFile(): int;

    /**
     * @return int
     */
    public function getPermissionPublicDirectory(): int;

    /**
     * @return int
     */
    public function getPermissionPrivateDirectory(): int;

    /**
     * @return int
     */
    public function getPermissionPrivateFile(): int;
}
