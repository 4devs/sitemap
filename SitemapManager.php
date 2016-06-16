<?php

namespace FDevs\Sitemap;

use FDevs\Sitemap\Exception\FactoryNotFoundException;
use FDevs\Sitemap\Factory\AbstractFactory;

class SitemapManager
{
    /**
     * @var AbstractFactory[]
     */
    private $factoryList = [];

    /**
     * @param string $name
     *
     * @return AbstractFactory
     *
     * @throws FactoryNotFoundException
     */
    public function get($name)
    {
        if (!$this->has($name)) {
            throw new FactoryNotFoundException($name);
        }

        return $this->factoryList[$name];
    }

    /**
     * @return array
     */
    public function getAllowed()
    {
        return array_keys($this->factoryList);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has($name)
    {
        return isset($this->factoryList[$name]);
    }

    /**
     * @param AbstractFactory $factory
     *
     * @return $this
     */
    public function add(AbstractFactory $factory)
    {
        $this->factoryList[$factory->getName()] = $factory;

        return $this;
    }
}
