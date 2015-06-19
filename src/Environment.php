<?php
/**
 * Environment.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 21/04/15 - 12:11
 */

namespace PowerLinks\Environment;

use PowerLinks\Environment\EnvironmentDetector\Detector;
use Exception;

class Environment
{
    /**
     * @var EnvironmentConfiguration
     */
    protected $configuration;

    /**
     * @var Detector
     */
    protected $detector;

    /**
     * @var string
     */
    protected $environment;

    /**
     * @param EnvironmentConfiguration $configuration
     * @param Detector $detector
     */
    function __construct(EnvironmentConfiguration $configuration, Detector $detector)
    {
        $this->configuration = $configuration;
        $this->detector = $detector;
        $this->setEnvironment($detector->getEnvironment());
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @param string $environment
     * @throws Exception
     */
    public function setEnvironment($environment)
    {
        if ( ! in_array($environment, $this->configuration->getEnvironmentsList())) {
            throw new Exception('Environment is not valid');
        }
        $this->environment = $environment;
    }

    /**
     * @return bool
     */
    public function isDevelopment()
    {
        return $this->checkEnvironment('development');
    }

    /**
     * @return bool
     */
    public function isTesting()
    {
        return $this->checkEnvironment('testing');
    }

    /**
     * @return bool
     */
    public function isQualityAssurance()
    {
        return $this->checkEnvironment('quality-assurance');
    }

    /**
     * @return bool
     */
    public function isStaging()
    {
        return $this->checkEnvironment('staging');
    }

    /**
     * @return bool
     */
    public function isProduction()
    {
        return $this->checkEnvironment('production');
    }

    /**
     * @param $environment
     * @return bool
     */
    public function checkEnvironment($environment)
    {
        if ($environment == $this->getEnvironment()) {
            return true;
        }
        return false;
    }

}