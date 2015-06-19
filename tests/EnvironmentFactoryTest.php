<?php
/**
 * EnvironmentFactoryTest.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 17/06/15 - 16:46
 */

namespace PowerLinks\Environment\Tests;

use PHPUnit_Framework_TestCase;
use org\bovigo\vfs\vfsStreamWrapper;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use org\bovigo\vfs\vfsStream;
use PowerLinks\Environment\EnvironmentFactory;

class EnvironmentFactoryTest extends PHPUnit_Framework_TestCase
{
    public function setUp() {
        $_SERVER['ENVIRONMENT'] = 'testing';
        vfsStreamWrapper::register();
        vfsStreamWrapper::setRoot(new vfsStreamDirectory('configDirectory'));
    }

    public function testCreateWithExistingDetector()
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

        $configFile = new vfsStreamFile('config.yml', 0775);
        $configFile->setContent($configFileContent);
        vfsStreamWrapper::getRoot()->addChild($configFile);

        $this->assertInstanceOf(
            'PowerLinks\Environment\Environment',
            EnvironmentFactory::create(vfsStream::url('configDirectory/config.yml'))
        );
    }

    /**
     * @expectedException Exception
     */
    public function testCreateWithMissingDetector()
    {
        $configFileContent = <<<EOF
detector: missing
environments:
  - development
  - testing
  - quality-assurance
  - staging
  - production
EOF;

        $configFile = new vfsStreamFile('missingDetectorConfig.yml', 0775);
        $configFile->setContent($configFileContent);
        vfsStreamWrapper::getRoot()->addChild($configFile);

        $this->assertInstanceOf(
            'PowerLinks\Environment\Environment',
            EnvironmentFactory::create(vfsStream::url('configDirectory/missingDetectorConfig.yml'))
        );
    }

    public function tearDown() {
        unset($_SERVER['ENVIRONMENT']);
    }
}