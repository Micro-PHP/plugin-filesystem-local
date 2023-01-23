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

namespace Micro\Plugin\Filesystem\Adapter\Local\Test\Unit\Decorator;

use League\Flysystem\FilesystemOperator;
use Micro\Plugin\Filesystem\Adapter\Local\Configuration\FilesystemLocalAdapterPluginConfigurationInterface;
use Micro\Plugin\Filesystem\Adapter\Local\Decorator\LocalFilesystemFacadeDecorator;
use Micro\Plugin\Filesystem\Business\FS\FsFactoryInterface;
use Micro\Plugin\Filesystem\Facade\FilesystemFacadeInterface;
use PHPUnit\Framework\TestCase;

class LocalFilesystemFacadeDecoratorTest extends TestCase
{
    public function testCreateFsOperator()
    {
        $fsOperator = $this->createMock(FilesystemOperator::class);

        $decorated = $this->createMock(FilesystemFacadeInterface::class);
        $decorated
            ->expects($this->once())
            ->method('createFsOperator')
            ->with('test')
            ->willReturn($fsOperator);

        $fsFactory = $this->createMock(FsFactoryInterface::class);
        $fsFactory->expects($this->never())->method('create');

        $cfg = $this->createMock(FilesystemLocalAdapterPluginConfigurationInterface::class);

        $decorator = new LocalFilesystemFacadeDecorator(
            $decorated,
            $fsFactory,
            $cfg
        );

        $this->assertEquals($fsOperator, $decorator->createFsOperator('test'));
    }
}
