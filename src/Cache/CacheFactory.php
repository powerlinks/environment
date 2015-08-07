<?php
/**
 * CacheFactory.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 22/06/15 - 10:16
 */
namespace PowerLinks\Environment\Cache;

use Stash\Driver\Apc;
use Stash\Pool;
use Exception;

class CacheFactory
{
    /**
     * @param $cacheType
     * @return Cache/null
     */
    public static function create($cacheType = 'apc')
    {
        $class = __NAMESPACE__.'\Cache'.ucfirst($cacheType);
        if ( ! class_exists($class)) {
            return null;
        }
        return call_user_func('self::create'.ucfirst($cacheType));
    }

    /**
     * @return Cache
     */
    public static function createApc()
    {
        try {
            $driver = new Apc();
            $driver->setOptions(['ttl' => 3600]);
        } catch (Exception $e) {
            die('Caught exception: '.$e->getMessage());
        }

        return new CacheApc(new Pool($driver));
    }
}