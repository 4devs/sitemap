<?php

namespace FDevs\Sitemap\Factory;

use FDevs\Sitemap\ElementInterface;

abstract class AbstractFactory
{
    /**
     * @var string
     */
    const XML_HEADER = '<?xml version="1.0" encoding="UTF-8"?>';

    /**
     * @return string
     */
    abstract public function getName();

    /**
     * generate sitemap.
     *
     * @param array $params
     *
     * @return ElementInterface
     */
    abstract protected function addElement(array $params = [], ElementInterface $root);

    /**
     * @return ElementInterface
     */
    abstract protected function createRoot();

    /**
     * @param array $params
     *
     * @return string
     */
    public function xmlString(array $params = [])
    {
        return self::XML_HEADER."\n".strval($this->createElement($params));
    }

    /**
     * @param string $filename
     * @param array  $params
     *
     * @return $this
     */
    public function saveFile($filename, array $params = [])
    {
        $fp = fopen($filename, 'w');
        fwrite($fp, $this->xmlString($params));
        fclose($fp);

        return $this;
    }

    /**
     * @param array $params
     *
     * @return ElementInterface
     */
    protected function createElement(array $params = [])
    {
        $root = $this->createRoot();
        foreach ($params as $param) {
            $this->addElement($param, $root);
        }

        return $root;
    }
}
