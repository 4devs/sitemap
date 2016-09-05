<?php

namespace FDevs\Sitemap\Tests\Adapter;

use FDevs\Sitemap\Adapter\AbstractAdapter;
use FDevs\Sitemap\Adapter\AdapterInterface;
use FDevs\Sitemap\Adapter\UrlIteratorInterface;
use PHPUnit\Framework\TestCase;

class AbstractAdapterTest extends TestCase
{
    /**
     * @var AbstractAdapter
     */
    private $adapter;

    /**
     * @return array
     */
    public function getDataForIsGranted()
    {
        return [
            // item, params
            [new \stdClass(), []],
            [null, ['action' => 'demo']],
        ];
    }

    public function testImplementsAdapterInterface()
    {
        $this->assertInstanceOf(AdapterInterface::class, $this->adapter);
    }

    /**
     * @dataProvider getDataForIsGranted
     *
     * @param mixed $item
     * @param array $params
     */
    public function testIsGrantedAllowsEverythingByDefault($item, array $params)
    {
        $this->assertTrue($this->adapter->isGranted($item, $params));
    }

    public function testGetUrlListShouldReturnUrlIteratorInterface()
    {
        $this
            ->adapter
            ->expects($this->once())
            ->method('getItemList')
            ->willReturn($this->createMock(\Iterator::class))
        ;

        $this->assertInstanceOf(UrlIteratorInterface::class, $this->adapter->getUrlList());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->adapter = $this->getMockForAbstractClass(AbstractAdapter::class);
    }
}
