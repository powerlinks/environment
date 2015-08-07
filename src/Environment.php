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
use PowerLinks\Environment\Cache\Cache;
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
     * @var Cache
     */
    protected $cache;

    /**
     * @var string
     */
    protected $environment;

    /**
     * @param EnvironmentConfiguration $configuration
     * @param Detector $detector
     * @param Cache $cache
     */
    function __construct(EnvironmentConfiguration $configuration, Detector $detector, Cache $cache = null)
    {
        $this->configuration = $configuration;
        $this->detector = $detector;
        $this->cache = $cache;

        $environment = $this->restoreEnvironmentFromCache();
        $this->setEnvironment($environment);
        if (is_null($environment)) {
            $this->saveEnvironmentToCache($environment);
        }
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    public function restoreEnvironmentFromCache()
    {
        if (is_null($this->cache)) {
            return null;
        }
        return $this->cache->restore();
    }

    public function saveEnvironmentToCache($environment)
    {
        if (is_null($this->cache)) {
            return null;
        }
        $this->cache->save($environment);
    }

    /**
     * @param string $environment
     * @throws Exception
     */
    public function setEnvironment($environment = null)
    {
        if (is_null($environment)) {
            $environment = $this->getEnvironmentFromDetector();
        }
        if ( ! in_array($environment, $this->configuration->getEnvironmentsList())) {
            $environment = $this->configuration->getDefaultEnvironment();
        }
        $this->environment = $environment;
    }

    /**
     * @return string
     */
    public function getEnvironmentFromDetector()
    {
        try {
            return $this->detector->getEnvironment();
        } catch (Exception $e) {
            return $this->configuration->getDefaultEnvironment();
        }
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
    public function isDemo()
    {
        return $this->checkEnvironment('demo');
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