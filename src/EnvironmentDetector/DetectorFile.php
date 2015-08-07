<?php
/**
 * DetectorFile.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 14/05/15 - 12:33
 */

namespace PowerLinks\Environment\EnvironmentDetector;


class DetectorFile implements Detector
{
    const FILE_NAME = '.env.php';
    /**
     * @var string
     */
    private $environment;

    /**
     * @param string $projectPath
     */
    function __construct($projectPath = '../..')
    {
        if ($filePath = $this->getFilePath($projectPath)) {
            $this->environment = require($filePath);
            return $this;
        }
        $this->environment = $filePath;
    }

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    public function getFilePath($projectPath)
    {
        $filePath = $projectPath.'/'.self::FILE_NAME;
        if (file_exists($filePath)) {
            return $filePath;
        }
        return null;
    }

}