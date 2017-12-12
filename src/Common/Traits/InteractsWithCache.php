<?php
/**
 * Created by PhpStorm.
 * User: hahaxixi2017
 * Date: 2017/12/8
 * Time: 22:37
 */
namespace AI\Common\Traits;

use AI\Common\ServiceContainer;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Cache\Simple\FilesystemCache;

trait InteractsWithCache
{
    /**
     * @var \Psr\SimpleCache\CacheInterface
     */
    protected $cache;

    /**
     * Get cache instance.
     *
     * @return \Psr\SimpleCache\CacheInterface
     */
    public function getCache()
    {
        if ($this->cache) {
            return $this->cache;
        }

        if (property_exists($this, 'app') && $this->app instanceof ServiceContainer
            && isset($this->app['cache']) && $this->app['cache'] instanceof CacheInterface) {
            return $this->cache = $this->app['cache'];
        }

        return $this->cache = $this->createDefaultCache();
    }

    /**
     * Set cache instance.
     *
     * @param \Psr\SimpleCache\CacheInterface $cache
     *
     * @return $this
     */
    public function setCache(CacheInterface $cache)
    {
        $this->cache = $cache;

        return $this;
    }

    /**
     * @return \Symfony\Component\Cache\Simple\FilesystemCache
     */
    protected function createDefaultCache()
    {
        return new FilesystemCache();
    }
}