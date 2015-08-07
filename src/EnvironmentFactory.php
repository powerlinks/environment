<?php
/**
 * EnvironmentFactory.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 17/06/15 - 16:46
 */

namespace PowerLinks\Environment;

use PowerLinks\Environment\Cache\CacheFactory;
use PowerLinks\Environment\EnvironmentDetector\DetectorsIterator;
use PowerLinks\Environment\EnvironmentDetector\DetectorsProcessor;

class EnvironmentFactory
{
    public static function create($configurationFile = null)
    {
        $configuration = new EnvironmentConfiguration($configurationFile);
        $detector = new DetectorsProcessor(new DetectorsIterator($configuration->getDetectorsOrder()));
        $cache = CacheFactory::create($configuration->getCacheType());
        return new Environment($configuration, $detector, $cache);
    }
}