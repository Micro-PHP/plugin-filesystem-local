<?php

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

    /**
     * @return string
     *
     * @see Visibility
     */
    public function getDefaultVisibilityForDirectories(): string;
}