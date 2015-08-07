<?php
/**
 * DetectorFactoryTest.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 07/08/15 - 17:20
 */
namespace PowerLinks\Environment\Tests\EnvironmentDetector;

use PHPUnit_Framework_TestCase;
use PowerLinks\Environment\EnvironmentDetector\DetectorFactory;
use Exception;

class DetectorFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCreation()
    {
        $this->assertInstanceOf(
            'PowerLinks\Environment\EnvironmentDetector\Detector',
            DetectorFactory::create('file')
        );
    }

    /**
     * @expectedException Exception
     */
    public function testMissingCreation()
    {
        DetectorFactory::create('missing');
    }
}