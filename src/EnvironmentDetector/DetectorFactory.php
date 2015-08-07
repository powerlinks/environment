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
    /**
     * @param string $detectorImplementationName
     * @return Detector
     * @throws Exception
     */
    public static function create($detectorImplementationName)
    {
        $class = __NAMESPACE__.'\Detector'.ucfirst($detectorImplementationName);
        if ( ! class_exists($class)) {
            throw new Exception('Detector class does not exist');
        }
        return new $class();
    }
}