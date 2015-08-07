<?php
/**
 * CacheFactoryTest.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 07/08/15 - 16:46
 */

namespace PowerLinks\Environment\Tests\Cache;

use PHPUnit_Framework_TestCase;
use PowerLinks\Environment\Cache\CacheFactory;

class CacheFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCacheCreation()
    {
        // this test needs "apc.enable_cli = 1" inside "/etc/php.d/apcu.ini"

        $this->assertInstanceOf('PowerLinks\Environment\Cache\Cache', CacheFactory::create());
    }

    public function testApcCacheCreation()
    {
        // this test needs "apc.enable_cli = 1" inside "/etc/php.d/apcu.ini"

        $this->assertInstanceOf('PowerLinks\Environment\Cache\Cache', CacheFactory::createApc());
    }
}