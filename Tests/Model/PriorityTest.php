<?php

namespace FDevs\Sitemap\Tests\Model;

use FDevs\Sitemap\Model\AbstractElement;
use FDevs\Sitemap\Model\Priority;
use PHPUnit\Framework\TestCase;

class PriorityTest extends TestCase
{
    use EmptyAttributesTrait;
    use GetNameReturnsStringTrait;

    /**
     * @var Priority
     */
    private $element;

    /**
     * @var float
     */
    private $priority;

    public function testGetNameShouldReturnConstantValue()
    {
        $this->assertEquals(AbstractElement::ELEMENT_PRIORITY, $this->element->getName());
    }

    public function testGetValueShouldRespectInitialValue()
    {
        $this->assertEquals($this->priority, $this->element->getValue());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->priority = 1.2;
        $this->element = new Priority($this->priority);
    }
}
