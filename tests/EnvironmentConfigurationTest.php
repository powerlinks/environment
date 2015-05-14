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
use PowerLinks\Environment\EnvironmentConfiguration;

class EnvironmentConfigurationTest extends PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $environmentConfiguration = new EnvironmentConfiguration();
        print_r($environmentConfiguration->getConfiguration());
    }
}