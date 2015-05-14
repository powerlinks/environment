<?php
/**
 * Detector.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 14/05/15 - 12:11
 */

namespace PowerLinks\Environment\EnvironmentDetector;

interface Detector
{
    /**
     * @return string
     */
    public function getEnvironment();
}