<?php
/**
 * Cache.php
 *
 * @copyright PowerLinks
 * @author Manuel Kanah <manuel@powerlinks.com>
 * Date: 07/08/15 - 13:09
 */

namespace PowerLinks\Environment\Cache;

interface Cache
{
    /**
     * @param mixed $value
     */
    public function save($value);

    /**
     * @return mixed
     */
    public function restore();
}