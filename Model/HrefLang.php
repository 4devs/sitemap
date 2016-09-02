<?php

namespace FDevs\Sitemap\Model;

class HrefLang extends AbstractElement
{
    /**
     * @var array
     */
    protected $attr = ['rel' => 'alternate'];

    /**
     * HrefLang constructor.
     */
    public function __construct($lang, $href)
    {
        $this->attr['hreflang'] = $lang;
        $this->attr['href'] = $href;
    }

    /**
     * {@inheritdoc}
     */
    public function getNamespace()
    {
        return ['xmlns:xhtml' => 'http://www.w3.org/1999/xhtml'];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'xhtml:link';
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttr()
    {
        return $this->attr;
    }
}
