<?php

namespace FDevs\Sitemap\Model;

class SiteMapIndex extends AbstractElement
{
    /**
     * @var array
     */
    protected $attr = ['xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9'];

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
