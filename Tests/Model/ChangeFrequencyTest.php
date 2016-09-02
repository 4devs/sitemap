<?php

namespace FDevs\Sitemap\Tests\Model;

use FDevs\Sitemap\Model\AbstractElement;
use FDevs\Sitemap\Model\ChangeFrequency;
use PHPUnit\Framework\TestCase;

class ChangeFrequencyTest extends TestCase
{
    use EmptyAttributesTrait;
    use GetNameReturnsStringTrait;

    /**
     * @var ChangeFrequency
     */
    private $element;

    public function testGetNameShouldReturnConstant()
    {
        $this->assertEquals(AbstractElement::ELEMENT_CHANGEFREQ, $this->element->getName());
    }

    public function testSetFrequencyMustReturnSelf()
    {
        $this->assertEquals($this->element, $this->element->setFrequency('weekly'));
    }

    public function testSetFrequencyAndGetValueShouldWorkTogether()
    {
        $this->element->setFrequency('always');
        $this->assertEquals('always', $this->element->getValue());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->element = new ChangeFrequency();
    }
}
