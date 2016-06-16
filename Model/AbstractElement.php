<?php

namespace FDevs\Sitemap\Model;

use FDevs\Sitemap\ElementInterface;

abstract class AbstractElement implements ElementInterface
{
    const ELEMENT_LOC = 'loc';
    const ELEMENT_PRIORITY = 'priority';
    const ELEMENT_LASTMOD = 'lastmod';
    const ELEMENT_CHANGEFREQ = 'changefreq';

    /**
     * @var array
     */
    private $namespaceList = [];

    /**
     * @return string
     */
    abstract public function getName();

    /**
     * @return string|null|AbstractElement[]
     */
    abstract public function getValue();

    /**
     * @return array
     */
    abstract public function getAttr();

    /**
     * @return array
     */
    public function getNamespace()
    {
        $value = $this->getValue();
        if (is_array($value)) {
            /** @var AbstractElement $item */
            foreach ($value as $item) {
                $this->namespaceList = array_merge($item->getNamespace(), $this->namespaceList);
            }
        }

        return $this->namespaceList;
    }

    /**
     * @param string $name
     * @param string $path
     *
     * @return $this
     */
    public function addNamespace($name, $path)
    {
        $this->namespaceList[$name] = $path;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        $strAttr = '';
        $attr = $this->getAttr();
        foreach ($attr as $name => $value) {
            $strAttr .= sprintf(' %s="%s"', $name, $value);
        }
        $strValue = '';
        $value = $this->getValue();
        if (is_array($value)) {
            foreach ($value as $item) {
                $strValue .= strval($item);
            }
        } else {
            $strValue = $value;
        }

        return sprintf($strValue ? '<%1$s%2$s>%3$s</%1$s>' : '<%1$s%2$s/>', $this->getName(), $strAttr, $strValue);
    }
}
