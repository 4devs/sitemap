<?php

namespace FDevs\Sitemap\Model;

class SiteMapIndex extends AbstractElement
{
    /**
     * @var SiteMap[]
     */
    protected $siteMapList = [];

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sitemapindex';
    }

    /**
     * @param SiteMap $map
     *
     * @return $this
     */
    public function addSiteMap(SiteMap $map)
    {
        $this->siteMapList[] = $map;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->siteMapList;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttr()
    {
        return [];
    }
}
