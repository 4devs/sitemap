<?php

namespace FDevs\Sitemap\Tests\Factory;

use FDevs\Sitemap\ElementInterface;
use FDevs\Sitemap\Factory\AbstractFactory;

class AbstractFactoryTest extends FactoryTestCase
{
    /**
     * {@inheritdoc}
     */
    public function getXmlStringProvider()
    {
        $baseXml = AbstractFactory::XML_HEADER."\n";

        return [
            // params, expected xml
            [
                [
                    [''],
                ],
                $baseXml,
            ],
            [
                [
                    ['<test/>'],
                ],
                $baseXml.'<test/>',
            ],
        ];
    }

    /**
     * @param array $params
     *
     * @return AbstractFactory|\PHPUnit_Framework_MockObject_MockObject
     */
    protected function getFactory(array $params = [])
    {
        $factory = $this->getMockForAbstractClass(AbstractFactory::class);
        $factory
            ->method('getName')
            ->willReturn('abstract factory')
        ;

        $xml = '';
        foreach ($params as $param) {
            $xml .= is_array($param) ? implode($param) : $param;
        }

        $this->mockFactoryRootElement($factory, $xml);

        return $factory;
    }

    /**
     * @param \PHPUnit_Framework_MockObject_MockObject $factory
     * @param string                                   $rootXml
     */
    private function mockFactoryRootElement($factory, $rootXml)
    {
        $rootElement = $this->createMock(ElementInterface::class);
        $rootElement
            ->method('__toString')
            ->willReturn($rootXml)
        ;

        $factory
            ->method('createRoot')
            ->willReturn($rootElement)
        ;
    }
}
