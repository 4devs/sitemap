<?php

namespace FDevs\Sitemap\Adapter;

use FDevs\Sitemap\Model\Url;

abstract class AbstractAdapter implements AdapterInterface
{
    /**
     * @param string $name
     * @param array  $params
     * @param mixed  $item
     *
     * @return null|Url
     */
    abstract public function createUrl($name, array $params, $item);

    /**
     * @param array $params
     *
     * @return \Iterator
     */
    abstract public function getItemList(array $params = []);

    /**
     * @param mixed $item
     * @param array $params
     *
     * @return bool
     */
    public function isGranted($item, array $params)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getUrlList(array $params = [])
    {
        return new UrlIterator($this->getItemList($params), $params, $this);
    }
}
