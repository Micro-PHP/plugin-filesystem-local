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

namespace Micro\Plugin\Filesystem\Adapter\Local\Test\Unit\Configuration\Adapter;

use Micro\Framework\Kernel\Configuration\DefaultApplicationConfiguration;
use Micro\Framework\Kernel\Configuration\Exception\InvalidConfigurationException;
use Micro\Plugin\Filesystem\Adapter\Local\Configuration\Adapter\LocalAdapterConfiguration;
use PHPUnit\Framework\TestCase;

class LocalAdapterConfigurationTest extends TestCase
{
    public function testGetLinkHeading()
    {
        $config = new DefaultApplicationConfiguration([
            'MICRO_FS_TEST_LINK_HANDLING' => 3, // Invalid value
        ]);

        $adapterCfg = new LocalAdapterConfiguration($config, 'test');

        $this->expectException(InvalidConfigurationException::class);
        $adapterCfg->getLinkHeading();
    }
}
