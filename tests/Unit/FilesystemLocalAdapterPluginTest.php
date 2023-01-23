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

namespace Micro\Plugin\Filesystem\Adapter\Local\Test\Unit;

use Micro\Kernel\App\AppKernel;
use Micro\Plugin\Filesystem\Adapter\Local\FilesystemLocalAdapterPlugin;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
use PHPUnit\Framework\TestCase;

class FilesystemLocalAdapterPluginTest extends TestCase
{
    public function testPlugin()
    {
        $kernel = new AppKernel(
            [
                'MICRO_FS_DEFAULT_TYPE' => 'local',
                'MICRO_FS_DEFAULT_ROOT_PATH' => '/tmp/micro/fs',
                'MICRO_FS_DEFAULT_LINK_HANDLING' => '1',
            ],
            [
                FilesystemLocalAdapterPlugin::class,
            ]
        );

        $kernel->run();
        /** @var FilesystemFacadeInterface $facade */
        $facade = $kernel->container()->get(FilesystemFacadeInterface::class);
        $operator = $facade->createFsOperator('default');

        $location = 'temporary';
        $operator->write($location, 'success');
        $this->assertEquals('success', $operator->read($location));
        $operator->delete($location);
    }
}
