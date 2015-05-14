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
    private $environment;

    /**
     * @throws Exception
     */
    function __construct()
    {
        if (isset($_SERVER[self::KEY])) {
            $this->environment = $_SERVER[self::KEY];
        } else {
            throw new Exception('Environment not specified as an env variable');
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