<?php
/**
 * EnvironmentTest.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 19/06/15 - 11:44
 */

namespace PowerLinks\Environment\Tests;

use PHPUnit_Framework_TestCase;
use PowerLinks\Environment\Environment;

class EnvironmentTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Environment
     */
    private $environment;

    public function setUp()
    {
        $this->environment = new Environment($this->getMockConfiguration(), $this->getMockDetector());
    }

    public function testGetEnvironment()
    {
        $this->assertEquals('testing', $this->environment->getEnvironment());
    }

    public function testSetCustomEnvironment()
    {
        $this->environment->setEnvironment('development');
        $this->assertEquals('development', $this->environment->getEnvironment());
    }

    public function testSetMissingEnvironment()
    {
        $this->environment->setEnvironment('missing-environment');
        $this->assertEquals('development', $this->environment->getEnvironment());
    }

    public function testIsDevelopment()
    {
        $this->assertFalse($this->environment->isDevelopment());
    }

    public function testIsTesting()
    {
        $this->assertTrue($this->environment->isTesting());
    }

    public function testIsQualityAssurance()
    {
        $this->assertFalse($this->environment->isQualityAssurance());
    }

    public function testIsStaging()
    {
        $this->assertFalse($this->environment->isStaging());
    }

    public function testIsProduction()
    {
        $this->assertFalse($this->environment->isProduction());
    }

    public function testCheckEnvironment()
    {
        $this->assertTrue($this->environment->checkEnvironment('testing'));
        $this->assertFalse($this->environment->checkEnvironment('development'));
    }

    private function getMockDetector()
    {
        $detector = $this->getMockBuilder('PowerLinks\Environment\EnvironmentDetector\Detector')
            ->setMethods(array('getEnvironment'))
            ->getMock();
        $detector->expects($this->once())
            ->method('getEnvironment')
            ->will($this->returnValue('testing'));
        return  $detector;
    }

    private function getMockConfiguration()
    {
        $configuration = $this->getMockBuilder('PowerLinks\Environment\EnvironmentConfiguration')
            ->setMethods(array('getEnvironmentsList'))
            ->getMock();
        $configuration->expects($this->atLeastOnce())
            ->method('getEnvironmentsList')
            ->will($this->returnValue([
                'development',
                'testing',
                'quality-assurance',
                'staging',
                'production'
            ]));
        $configuration->method('getDefaultEnvironment')
            ->will($this->returnValue('development'));
        return $configuration;
    }
}