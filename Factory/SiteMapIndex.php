<?php

namespace FDevs\Sitemap\Factory;

use FDevs\Sitemap\ElementInterface;
use FDevs\Sitemap\Model\SiteMap;
use FDevs\Sitemap\Model\SiteMapIndex as Root;

class SiteMapIndex extends AbstractFactory
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $dir;

    /**
     * @var UrlSet
     */
    private $urlSet;

    /**
     * @var string
     */
    private $basename = 'sitemap.xml';

    /**
     * SiteMapIndexFactory constructor.
     *
     * @param string      $uri
     * @param string      $dir
     * @param UrlSet|null $urlSet
     */
    public function __construct($uri, $dir, UrlSet $urlSet = null)
    {
        $this->uri = $uri;
        $this->dir = $dir;
        $this->urlSet = $urlSet ?: new UrlSet();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'index';
    }

    /**
     * @param string $basename
     *
     * @return SiteMapIndex
     */
    public function setBasename($basename)
    {
        $this->basename = $basename;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function addElement(array $params = [], ElementInterface $root)
    {
        /* @var Root $root */
        $fileName = (count($params) ? implode('.', $params).'.' : '').$this->basename;
        $this->urlSet->saveFile($this->dir.DIRECTORY_SEPARATOR.$fileName, [$params]);
        $siteMap = new SiteMap(rtrim($this->uri, '/').'/'.$fileName);
        if ($last = $this->urlSet->getLastMod()) {
            $siteMap->setLastModification($last);
        }
        $root->addSiteMap($siteMap);

        return $root;
    }

    /**
     * {@inheritdoc}
     */
    protected function createRoot()
    {
        return new Root();
    }
}
