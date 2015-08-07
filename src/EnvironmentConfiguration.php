<?php
/**
 * EnvironmentConfiguration.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 14/05/15 - 12:46
 */

namespace PowerLinks\Environment;

use Symfony\Component\Yaml\Yaml;

class EnvironmentConfiguration
{
    /**
     * @var array
     */
    protected $configuration;

    /**
     * @var string/null $configurationFile
     */
    protected $configurationFile = null;

    function __construct($configurationFile = null)
    {
        $this->setConfigurationFilePath($configurationFile);
        $this->configuration = Yaml::parse(file_get_contents($this->getConfigurationFilePath()));
    }

    /**
     * @return array
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @return array
     */
    public function getEnvironmentsList()
    {
        return $this->configuration['environments'];
    }

    /**
     * @return array
     */
    public function getDetectorsOrder()
    {
        return $this->configuration['detectors_order'];
    }

    /**
     * @return string
     */
    public function getDefaultEnvironment()
    {
        return $this->configuration['default_environment'];
    }

    /**
     * @return string
     */
    public function getConfigurationFilePath()
    {
        return $this->configurationFile;
    }

    /**
     * @return string
     */
    public function getCacheType()
    {
        return $this->configuration['cache_type'];
    }

    /**
     * @param string/null $configurationFile
     */
    public function setConfigurationFilePath($configurationFile = null)
    {
        if (is_null($configurationFile)) {
            $configurationFile = realpath(__DIR__ . '/../config/config.yml');
        }
        $this->configurationFile = $configurationFile;
    }

}