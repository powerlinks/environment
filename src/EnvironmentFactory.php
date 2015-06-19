<?php
/**
 * EnvironmentFactory.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 17/06/15 - 16:46
 */

namespace PowerLinks\Environment;

use Exception;

use PowerLinks\Environment\EnvironmentDetector\DetectorFactory;

class EnvironmentFactory
{
    public static function create($configurationFile = null)
    {
        $configuration = new EnvironmentConfiguration($configurationFile);
        try {
            $detector = DetectorFactory::create($configuration->getDetector());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return new Environment($configuration, $detector);
    }
}