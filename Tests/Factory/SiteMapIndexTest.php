<?php

namespace FDevs\Sitemap\Tests\Factory;

use FDevs\Sitemap\Factory\AbstractFactory;
use FDevs\Sitemap\Factory\SiteMapIndex;

class SiteMapIndexTest extends FactoryTestCase
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
                $baseXml."\n<sitemapindex/>",
            ],
            [
                [
                    ['demo'],
                    ['blog'],
                    ['x1', 'x2'],
                ],
                $baseXml.<<<'EOT'

<sitemapindex><sitemap><loc>http://example.com/demo.sitemap.xml</loc></sitemap><sitemap><loc>http://example.com/blog.sitemap.xml</loc></sitemap><sitemap><loc>http://example.com/x1.x2.sitemap.xml</loc></sitemap></sitemapindex>
EOT
                ,
            ],
        ];
    }

    public function testSetBasenameShouldReturnSelf()
    {
        $factory = $this->getFactory();

        $this->assertEquals($factory, $factory->setBasename('demo-name'));
    }

    /**
     * @param array $params
     *
     * @return SiteMapIndex
     */
    protected function getFactory(array $params = [])
    {
        return new SiteMapIndex('http://example.com', $this->getFsRootDir()->url());
    }
}
