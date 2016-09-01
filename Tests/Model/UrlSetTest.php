<?php

namespace FDevs\Sitemap\Tests\Model;

use FDevs\Sitemap\Model\Url;
use FDevs\Sitemap\Model\UrlSet;
use PHPUnit\Framework\TestCase;

class UrlSetTest extends TestCase
{
    use GetNameReturnsStringTrait;

    /**
     * @var UrlSet
     */
    private $element;

    /**
     * @return array
     */
    public function getValueTestData()
    {
        return [
            [
                [],
                [],
            ],
            [
                [$this->createMock(Url::class)],
                [$this->createMock(Url::class)],
            ],
            [
                [
                    $this->createMock(Url::class),
                    $this->createMock(Url::class),
                ],
                [
                    $this->createMock(Url::class),
                    $this->createMock(Url::class),
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getAttrTestData()
    {
        return [
            [
                [],
                // default attribute
                [
                    'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9',
                ],
            ],
            [
                [
                    'attr1' => 'value1',
                    'attr2' => 'value2',
                ],
                [
                    'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9',
                    'attr1' => 'value1',
                    'attr2' => 'value2',
                ],
            ],
        ];
    }

    public function testAddUrlShouldReturnSelf()
    {
        $this->assertEquals($this->element, $this->element->addUrl($this->createMock(Url::class)));
    }

    /**
     * @dataProvider getValueTestData
     *
     * @param array|Url[] $urls
     * @param array|Url[] $expectedValue
     */
    public function testGetValueShouldRespectAddedUrls(array $urls, array $expectedValue)
    {
        foreach ($urls as $url) {
            $this->element->addUrl($url);
        }

        $this->assertEquals($expectedValue, $this->element->getValue());
    }

    public function testAddAttrShouldReturnSelf()
    {
        $this->assertEquals($this->element, $this->element->addAttr('test-name', 'test-value'));
    }

    /**
     * @dataProvider getAttrTestData
     *
     * @param array $attributes
     * @param array $expectedAttributes
     */
    public function testGetAttrShouldRespectAddedAttributes(array $attributes, array $expectedAttributes)
    {
        foreach ($attributes as $name => $value) {
            $this->element->addAttr($name, $value);
        }

        $this->assertEquals($expectedAttributes, $this->element->getAttr());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->element = new UrlSet();
    }
}
