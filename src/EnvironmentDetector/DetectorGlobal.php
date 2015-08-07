<?php
/**
 * DetectorGlobal.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 14/05/15 - 12:35
 */

namespace PowerLinks\Environment\EnvironmentDetector;

use Exception;

class DetectorGlobal implements Detector
{
    const KEY = 'ENVIRONMENT';

    /**
     * @var string
     */
    private $environment = null;

    /**
     * @throws Exception
     */
    function __construct()
    {
        if (isset($_SERVER[self::KEY])) {
            $this->environment = $_SERVER[self::KEY];
        }
    }

    /**
     * @return mixed
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

}