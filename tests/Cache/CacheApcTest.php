<?php
/**
 * CacheApcTest.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 07/08/15 - 16:42
 */

namespace PowerLinks\Environment\Tests\Cache;

use PHPUnit_Framework_TestCase;
use PowerLinks\Environment\Cache\CacheApc;

class CacheApcTest extends PHPUnit_Framework_TestCase
{
    private $cacheApc;

    public function setUp()
    {
        $this->cacheApc = new CacheApc($this->getMockPoolInterface());
        $this->assertInstanceOf('PowerLinks\Environment\Cache\Cache', $this->cacheApc);
    }

    public function testRestore()
    {
        $this->assertEquals('aValue', $this->cacheApc->restore());
    }

    public function testSave()
    {
        $this->cacheApc->save('myEnvironment');
    }

    private function getMockPoolInterface()
    {
        $item = $this->getMockBuilder('Stash\Interfaces\ItemInterface')
            ->getMock();
        $item->method('set')
            ->with($this->equalTo('myEnvironment'));
        $item->method('get')
            ->will($this->returnValue('aValue'));

        $pool = $this->getMockBuilder('Stash\Interfaces\PoolInterface')
            ->getMock();
        $pool->expects($this->once())
            ->method('getItem')
            ->with($this->equalTo('environment'))
            ->will($this->returnValue($item));
        return $pool;
    }
}