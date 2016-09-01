<?php

namespace FDevs\Sitemap\Tests\Model;

use FDevs\Sitemap\Model\AbstractElement;
use FDevs\Sitemap\Model\LastModification;
use FDevs\Sitemap\Model\Loc;
use FDevs\Sitemap\Model\Priority;
use FDevs\Sitemap\Model\Url;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{
    use EmptyAttributesTrait;
    use GetNameReturnsStringTrait;

    /**
     * @var Url
     */
    private $element;

    /**
     * @return array
     */
    public function getLastModTestData()
    {
        $date = new \DateTime();

        return [
            [null, null],
            [$date, $date],
            [new LastModification($date), $date],
        ];
    }

    /**
     * @return array
     */
    public function getElements()
    {
        return [
            'initial' => [
                [],
                [
                    $this->createLoc(),
                ],
            ],
            'nested elements' => [
                [
                    $this->createLoc(),
                    new Priority(),
                    new LastModification(new \DateTime()),
                ],
                [
                    $this->createLoc(),
                    new Priority(),
                    new LastModification(new \DateTime()),
                ],
            ],
            'test unique elements' => [
                [
                    $this->createLoc('test-loc-1'),
                    $this->createLoc('test-loc-2'),
                ],
                [
                    $this->createLoc('test-loc-2'),
                ],
            ],
        ];
    }

    public function testSetLocShouldReturnSelf()
    {
        $this->assertEquals($this->element, $this->element->setLoc($this->createLoc()));
    }

    public function testSetPriorityShouldReturnSelf()
    {
        $this->assertEquals($this->element, $this->element->setPriority(1.3));
    }

    public function testSetChangeFreqShouldReturnSelf()
    {
        $this->assertEquals($this->element, $this->element->setChangeFreq('always'));
    }

    public function testSetLastModShouldReturnSelf()
    {
        $this->assertEquals($this->element, $this->element->setLastMod(new \DateTime()));
    }

    /**
     * @dataProvider getLastModTestData
     *
     * @param null|\DateTime|LastModification $lastMod
     * @param null|\DateTime                  $expectedMod
     */
    public function testSetAndGetLastModShouldWorkTogether($lastMod, $expectedMod)
    {
        if ($lastMod) {
            $this->element->setLastMod($lastMod);
        }

        $this->assertEquals($expectedMod, $this->element->getLastMod());
    }

    public function testAddElementShouldReturnSelf()
    {
        $this->assertEquals($this->element, $this->element->addElement($this->createLoc()));
    }

    /**
     * @dataProvider getElements
     *
     * @param array|AbstractElement[] $elements
     * @param array|AbstractElement[] $expectedElements
     */
    public function testGetValueShouldRespectAddedElements(array $elements, array $expectedElements)
    {
        foreach ($elements as $element) {
            $this->element->addElement($element);
        }

        $this->assertEquals($expectedElements, $this->element->getValue());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->element = new Url($this->createLoc());
    }

    /**
     * @param string $location
     *
     * @return Loc
     */
    private function createLoc($location = 'test-location')
    {
        return new Loc($location);
    }
}
