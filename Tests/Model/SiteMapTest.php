<?php

namespace FDevs\Sitemap\Tests\Model;

use FDevs\Sitemap\Model\LastModification;
use FDevs\Sitemap\Model\Loc;
use FDevs\Sitemap\Model\SiteMap;
use PHPUnit\Framework\TestCase;

class SiteMapTest extends TestCase
{
    use EmptyAttributesTrait;
    use GetNameReturnsStringTrait;

    /**
     * @var string
     */
    private $location;

    /**
     * @var SiteMap
     */
    private $element;

    /**
     * @return array
     */
    public function getValueTestData()
    {
        $date = new \DateTime();
        $location = new Loc('test-location');

        return [
            [
                $date,
                $location,
                [
                    $location,
                    new LastModification($date),
                ],
            ],
            [
                new LastModification($date),
                $location,
                [
                    $location,
                    new LastModification($date),
                ],
            ],
        ];
    }

    public function testSetLastModificationShouldReturnSelf()
    {
        $this->assertEquals($this->element, $this->element->setLastModification(new \DateTime()));
    }

    public function testSetLocationShouldReturnSelf()
    {
        $this->assertEquals($this->element, $this->element->setLoc(new Loc('test-location')));
    }

    public function testGetValueShouldRespectInitialLocation()
    {
        $this->assertEquals([new Loc($this->location)], $this->element->getValue());
    }

    /**
     * @dataProvider getValueTestData
     *
     * @param LastModification|\DateTime $modification
     * @param Loc                        $location
     * @param array                      $expected
     */
    public function testGetValueShouldRespectModificationAndLocation($modification, $location, array $expected)
    {
        $this->element->setLastModification($modification);
        $this->element->setLoc($location);

        $this->assertEquals($expected, $this->element->getValue());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->location = 'test-location';
        $this->element = new SiteMap($this->location);
    }
}
