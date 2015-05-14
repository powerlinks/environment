<?php
/**
 * Environment.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 21/04/15 - 12:11
 */

namespace PowerLinks\Environment;


class Environment
{
    /**
     * @var string
     */
    protected $environment;

    /**
     *
     */
    function __construct()
    {
        // TODO: detect the environment
        $this->environment = 'dev';
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @return bool
     */
    public function isDev()
    {
        if ($this->environment != 'dev') {
            return false;
        }

        return true;
    }
}