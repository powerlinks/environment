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
     * @return string
     */
    public function getDetector()
    {
        return $this->configuration['detector'];
    }


    public function getConfigurationFilePath()
    {
        return $this->configurationFile;
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