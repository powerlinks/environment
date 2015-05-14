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

    function __construct()
    {
        $this->configuration = Yaml::parse(file_get_contents(__DIR__ . '/../config/config.yml'));
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
        return $this->configuration['construct'];
    }
}