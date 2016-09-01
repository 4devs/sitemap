<?php

namespace FDevs\Sitemap\Tests\Model;

use FDevs\Sitemap\Model\SiteMap;
use FDevs\Sitemap\Model\SiteMapIndex;
use PHPUnit\Framework\TestCase;

class SiteMapIndexTest extends TestCase
{
    use EmptyAttributesTrait;
    use GetNameReturnsStringTrait;

    /**
     * @var SiteMapIndex
     */
    private $element;

    /**
     * @return array
     */
    public function getSiteMapTestData()
    {
        $siteMap = new SiteMap('test-location');

        return [
            [
                [],
                [],
            ],
            [
                [$siteMap],
                [$siteMap],
            ],
            [
                [$siteMap, $siteMap],
                [$siteMap, $siteMap],
            ],
        ];
    }

    public function testAddSiteMapShouldReturnSelf()
    {
        $this->assertEquals($this->element, $this->element->addSiteMap(new SiteMap('test-location')));
    }

    /**
     * @dataProvider getSiteMapTestData
     *
     * @param array|SiteMap[] $siteMaps
     * @param array           $expected
     */
    public function testGetValueShouldReturnAnArrayOfAddedSiteMaps(array $siteMaps, array $expected)
    {
        foreach ($siteMaps as $siteMap) {
            $this->element->addSiteMap($siteMap);
        }

        $this->assertEquals($expected, $this->element->getValue());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->element = new SiteMapIndex();
    }
}
