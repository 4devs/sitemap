<?php

namespace FDevs\Sitemap\Model;

use FDevs\Sitemap\ElementInterface;

class UrlSet extends AbstractElement
{
    /**
     * @var array
     */
    private $attr = ['xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9'];

    /**
     * @var ElementInterface[]
     */
    private $elements = [];

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'urlset';
    }

    /**
     * @param Url $url
     *
     * @return $this
     */
    public function addUrl(Url $url)
    {
        $this->elements[] = $url;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->elements;
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return $this
     */
    public function addAttr($name, $value)
    {
        $this->attr[$name] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttr()
    {
        return $this->attr;
    }
}
