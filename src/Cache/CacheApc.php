<?php
/**
 * CacheApc.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 07/08/15 - 15:15
 */

namespace PowerLinks\Environment\Cache;

use Stash\Interfaces\PoolInterface;
use Stash\Interfaces\ItemInterface;

class CacheApc implements Cache
{
    /**
     * @var ItemInterface
     */
    private $cache;

    /**
     * @param PoolInterface $cache
     */
    public function __construct(PoolInterface $cache)
    {
        $this->cache = $cache->getItem('environment');
    }

    /**
     * @param mixed $value
     * @return $this
     */
    public function save($value)
    {
        $this->cache->set($value);
        return $this;
    }

    /**
     * Returns data that was previously stored, or null if nothing stored.
     *
     * @return mixed
     */
    public function restore()
    {
        return $this->cache->get();
    }

    /**
     * @return ItemInterface
     */
    public function getCache()
    {
        return $this->cache;
    }
}