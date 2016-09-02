<?php

namespace FDevs\Sitemap\Tests\Model;

use FDevs\Sitemap\Model\HrefLang;
use PHPUnit\Framework\TestCase;

class HrefLangTest extends TestCase
{
    use GetNameReturnsStringTrait;

    /**
     * @var HrefLang
     */
    private $element;

    /**
     * @var string
     */
    private $lang;

    /**
     * @var string
     */
    private $href;

    public function testGetNamespaceMustBeAnArray()
    {
        $this->assertTrue(is_array($this->element->getNamespace()));
    }

    public function testElementHasNoValue()
    {
        $this->assertNull($this->element->getValue());
    }

    public function testGetAttrShouldRespectInitialAttributes()
    {
        $this->assertArraySubset(['hreflang' => $this->lang, 'href' => $this->href], $this->element->getAttr());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->lang = 'ru';
        $this->href = 'http://example.com';

        $this->element = new HrefLang($this->lang, $this->href);
    }
}
