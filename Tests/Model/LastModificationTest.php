<?php

namespace FDevs\Sitemap\Tests\Model;

use FDevs\Sitemap\Model\AbstractElement;
use FDevs\Sitemap\Model\LastModification;
use PHPUnit\Framework\TestCase;

class LastModificationTest extends TestCase
{
    use EmptyAttributesTrait;
    use GetNameReturnsStringTrait;

    /**
     * @var LastModification
     */
    private $element;

    /**
     * @var \DateTime
     */
    private $date;

    public function testGetNameShouldReturnConstantValue()
    {
        $this->assertEquals(AbstractElement::ELEMENT_LASTMOD, $this->element->getName());
    }

    public function testGetValueMustReturnFormattedDate()
    {
        $this->assertInternalType('integer', strtotime($this->element->getValue()));
    }

    public function testGetDateShouldReturnInitialDate()
    {
        $this->assertEquals($this->date, $this->element->getDate());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->date = new \DateTime();
        $this->element = new LastModification($this->date);
    }
}
