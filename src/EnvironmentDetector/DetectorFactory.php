<?php
/**
 * DetectorFactory.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 17/06/15 - 17:10
 */

namespace PowerLinks\Environment\EnvironmentDetector;

use Exception;

class DetectorFactory
{
    public static function create($detectorImplementation)
    {
        $class = __NAMESPACE__.'\Detector'.ucfirst($detectorImplementation);
        if ( ! class_exists($class)) {
            throw new Exception('Detector class does not exist');
        }
        return new $class();
    }
}