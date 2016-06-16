<?php

namespace FDevs\Sitemap\Factory;

use FDevs\Sitemap\Adapter\AdapterInterface;
use FDevs\Sitemap\ElementInterface;
use FDevs\Sitemap\Model\Url;
use FDevs\Sitemap\Model\UrlSet as Root;

class UrlSet extends AbstractFactory
{
    /**
     * @var AdapterInterface[]
     */
    private $adapterList = [];

    /**
     * @var \DateTime|null
     */
    private $lastMod;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sitemap';
    }

    /**
     * @return \DateTime|null
     */
    public function getLastMod()
    {
        return $this->lastMod;
    }

    /**
     * {@inheritdoc}
     */
    protected function addElement(array $params = [], ElementInterface $root)
    {
        /* @var Root $root */
        foreach ($this->adapterList as $adapter) {
            $urlList = $adapter->getUrlList($params);
            foreach ($urlList as $url) {
                if ($url instanceof Url) {
                    $root->addUrl($url);
                    $lastMod = $url->getLastMod();
                    $namespace = $url->getNamespace();
                    foreach ($namespace as $name => $path) {
                        $root->addAttr($name, $path);
                    }
                    $this->lastMod = $lastMod ? (!$this->lastMod || $lastMod > $this->lastMod ? $lastMod : $this->lastMod) : null;
                }
            }
        }

        return $root;
    }

    /**
     * {@inheritdoc}
     */
    protected function createRoot()
    {
        $this->lastMod = null;

        return new Root();
    }

    /**
     * @param AdapterInterface $adapter
     *
     * @return $this
     */
    public function addAdapter(AdapterInterface $adapter)
    {
        $this->adapterList[] = $adapter;

        return $this;
    }
}
