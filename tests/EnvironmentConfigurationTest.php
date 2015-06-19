<?php
/**
 * EnvironmentConfigurationTest.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 14/05/15 - 12:51
 */

namespace PowerLinks\Environment\Tests;

use PHPUnit_Framework_TestCase;
use org\bovigo\vfs\vfsStreamWrapper;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use org\bovigo\vfs\vfsStream;
use PowerLinks\Environment\EnvironmentConfiguration;

class EnvironmentConfigurationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var EnvironmentConfiguration
     */
    private $environmentConfiguration;

    public function setUp()
    {
        $configFileContent = <<<EOF
detector: global
environments:
  - development
  - testing
  - quality-assurance
  - staging
  - production
EOF;
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('configDirectory'));
        $configFile = new vfsStreamFile('config.yml', 0775);
        $configFile->setContent($configFileContent);
        vfsStreamWrapper::getRoot()->addChild($configFile);

        $this->environmentConfiguration = new EnvironmentConfiguration(vfsStream::url('configDirectory/config.yml'));
    }

    public function testGetConfiguration()
    {
        $expectedResult = [
            'detector' => 'global',
            'environments' => [
                'development',
                'testing',
                'quality-assurance',
                'staging',
                'production'
            ]
        ];
        $returnedResult = $this->environmentConfiguration->getConfiguration();
        $this->assertTrue(is_array($returnedResult));
        $this->assertEquals($expectedResult, $returnedResult);
    }

    public function testGetEnvironmentsList()
    {
        $expectedResult = [
            'development',
            'testing',
            'quality-assurance',
            'staging',
            'production'
        ];
        $this->assertEquals($expectedResult, $this->environmentConfiguration->getEnvironmentsList());
    }

    public function testGetDetector()
    {
        $this->assertEquals('global', $this->environmentConfiguration->getDetector());
    }

    public function testGetConfigurationFilePath()
    {
        $this->assertEquals(
            vfsStream::url('configDirectory/config.yml'),
            $this->environmentConfiguration->getConfigurationFilePath()
        );
    }

    public function testDefaultSetConfigurationFilePath()
    {
        $environmentConfiguration = new EnvironmentConfiguration();
        $this->assertEquals(
            realpath(__DIR__ . '/../config/config.yml'),
            $environmentConfiguration->getConfigurationFilePath()
        );
    }

    public function testCustomSetConfigurationFilePath()
    {
        $this->environmentConfiguration->setConfigurationFilePath(vfsStream::url('configDirectory/config.yml'));
        $this->assertEquals(
            vfsStream::url('configDirectory/config.yml'),
            $this->environmentConfiguration->getConfigurationFilePath()
        );
    }
}