<?php

namespace FDevs\Sitemap\Tests\Model;

use FDevs\Sitemap\Model\AbstractElement;
use FDevs\Sitemap\Model\Loc;
use PHPUnit\Framework\TestCase;

class LocTest extends TestCase
{
    use EmptyAttributesTrait;
    use GetNameReturnsStringTrait;

    /**
     * @var Loc
     */
    private $element;

    /**
     * @var string
     */
    private $value;

    public function testGetNameShouldReturnConstantValue()
    {
        $this->assertEquals(AbstractElement::ELEMENT_LOC, $this->element->getName());
    }

    public function testGetValueShouldRespectInitialValue()
    {
        $this->assertEquals($this->value, $this->element->getValue());
    }

    public function testSetValueShouldReturnSelf()
    {
        $this->assertEquals($this->element, $this->element->setValue('test'));
    }

    public function testSetAndGetValueShouldWorkTogether()
    {
        $expected = 'test';
        $this->element->setValue($expected);
        $this->assertEquals($expected, $this->element->getValue());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->value = 'initial';
        $this->element = new Loc($this->value);
    }
}
