<?php
/**
 * DetectorsProcessor.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 07/08/15 - 12:39
 */
namespace PowerLinks\Environment\EnvironmentDetector;

use Exception;

class DetectorsProcessor implements Detector
{
    /**
     * @var DetectorsIterator
     */
    private $detectors;

    /**
     * @param DetectorsIterator $detectors
     */
    public function __construct(DetectorsIterator $detectors)
    {
        $this->detectors = $detectors;
    }

    /**
     * @return null|string
     * @throws Exception
     */
    public function getEnvironment()
    {
        $environment = null;
        try {
            foreach ($this->detectors as $detector) {
                if ($environment = $detector->getEnvironment()) {
                    return $environment;
                }
            }
        } catch (Exception $e) {
            return null;
        }
    }
}