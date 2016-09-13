<?php

namespace FDevs\Sitemap\Tests\Factory;

use FDevs\Sitemap\Adapter\AdapterInterface;
use FDevs\Sitemap\Factory\AbstractFactory;
use FDevs\Sitemap\Factory\UrlSet;

class UrlSetTest extends FactoryTestCase
{
    /**
     * {@inheritdoc}
     */
    public function getXmlStringProvider()
    {
        $baseXml = AbstractFactory::XML_HEADER;

        return [
            // params, expected xml
            'empty params' => [
                [],
                $baseXml."\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"/>",
            ],
            'if has no adapters, then should ignore params' => [
                [
                    [
                        'url1',
                        'url2',
                    ],
                ],
                $baseXml."\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"/>",
            ],
        ];
    }

    public function testGetLastModShouldReturnDateTimeOrNull()
    {
        $mod = $this->getFactory()->getLastMod();

        $this->assertTrue(is_null($mod) || $mod instanceof \DateTime);
    }

    public function testAddAdapterShouldReturnSelf()
    {
        $factory = $this->getFactory();

        $this->assertEquals($factory, $factory->addAdapter($this->createMock(AdapterInterface::class)));
    }

    /**
     * @param array $params
     *
     * @return UrlSet
     */
    protected function getFactory(array $params = [])
    {
        return new UrlSet();
    }
}
