<?php
/**
 * DetectorsIterator.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 07/08/15 - 12:10
 */

namespace PowerLinks\Environment\EnvironmentDetector;

use Iterator;
use Exception;

class DetectorsIterator implements Iterator
{
    /**
     * @var int
     */
    private $position;

    /**
     * @var array
     */
    protected $detectors;

    /**
     * @param array $detectors
     */
    public function __construct(array $detectors)
    {
        $this->position = 0;
        $this->detectors = $detectors;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * @return Detector
     * @throws Exception
     */
    public function current()
    {
        try {
            return DetectorFactory::create($this->detectors[$this->position]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->detectors[$this->position]);
    }
}