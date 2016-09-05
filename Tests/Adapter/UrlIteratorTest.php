<?php

namespace FDevs\Sitemap\Tests\Adapter;

use FDevs\Sitemap\Adapter\AbstractAdapter;
use FDevs\Sitemap\Adapter\UrlIterator;
use FDevs\Sitemap\Adapter\UrlIteratorInterface;
use FDevs\Sitemap\Model\Url;
use PHPUnit\Framework\TestCase;

class UrlIteratorTest extends TestCase
{
    /**
     * @var UrlIterator
     */
    private $urlIterator;

    /**
     * @var AbstractAdapter
     */
    private $adapter;

    /**
     * @return array
     */
    public function getCurrent()
    {
        return [
            // isGranted, return value
            [true, new Url('test-url')],
            [false, null],
        ];
    }

    public function testShouldImplementUrlIteratorInterface()
    {
        $this->assertInstanceOf(UrlIteratorInterface::class, $this->urlIterator);
    }

    /**
     * @dataProvider getCurrent
     *
     * @param bool  $isGranted
     * @param mixed $expectedValue
     */
    public function testCurrentShouldHonorPrivacy($isGranted, $expectedValue)
    {
        $this
            ->adapter
            ->expects($this->once())
            ->method('isGranted')
            ->willReturn($isGranted)
        ;

        $this
            ->adapter
            ->method('createUrl')
            ->willReturn($expectedValue)
        ;

        $this->assertEquals($expectedValue, $this->urlIterator->current());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->adapter = $this->createMock(AbstractAdapter::class);
        $this->urlIterator = new UrlIterator($this->createMock(\Iterator::class), [], $this->adapter);
    }
}
