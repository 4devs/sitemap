<?php

namespace FDevs\Sitemap\Tests;

use FDevs\Sitemap\Factory\AbstractFactory;
use FDevs\Sitemap\SitemapManager;
use PHPUnit\Framework\TestCase;

class SitemapManagerTest extends TestCase
{
    /**
     * @var SitemapManager
     */
    private $sitemapManager;

    /**
     * @return array
     */
    public function getAllowedProvider()
    {
        return [
            'empty set' => [
                // factories, expected names
                [],
                [],
            ],
            'exact match' => [
                [
                    $this->mockFactory('url'),
                    $this->mockFactory('site'),
                ],
                [
                    'url',
                    'site',
                ],
            ],
            'duplicated factories override each other' => [
                [
                    $this->mockFactory('url'),
                    $this->mockFactory('url'),
                ],
                [
                    'url',
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getHasProvider()
    {
        return [
            // factories, name to test, expected result
            [
                [],
                'unknown',
                false,
            ],
            [
                [
                    $this->mockFactory('url'),
                ],
                'url',
                true,
            ],
        ];
    }

    public function testAddShouldReturnSelf()
    {
        $this->assertEquals($this->sitemapManager, $this->sitemapManager->add($this->mockFactory()));
    }

    /**
     * @dataProvider getHasProvider
     *
     * @param array|AbstractFactory[] $factories
     * @param string                  $nameToTest
     * @param bool                    $expectedResult
     */
    public function testHasShouldReturnBool(array $factories, $nameToTest, $expectedResult)
    {
        foreach ($factories as $factory) {
            $this->sitemapManager->add($factory);
        }

        $this->assertEquals($expectedResult, $this->sitemapManager->has($nameToTest));
    }

    /**
     * @dataProvider getAllowedProvider
     *
     * @param array|AbstractFactory[] $factories
     * @param array                   $expectedNames
     */
    public function testGetAllowedShouldReturnArrayOfFactoryNames(array $factories, array $expectedNames)
    {
        foreach ($factories as $factory) {
            $this->sitemapManager->add($factory);
        }

        $this->assertEquals($expectedNames, $this->sitemapManager->getAllowed());
    }

    public function testGetShouldReturnAbstractFactory()
    {
        $factory = $this->mockFactory('url');
        $this->sitemapManager->add($factory);

        $this->assertEquals($factory, $this->sitemapManager->get('url'));
    }

    /**
     * @expectedException \FDevs\Sitemap\Exception\FactoryNotFoundException
     */
    public function testGetShouldThrowExceptionForUnknownFactory()
    {
        $this->sitemapManager->get('unknown');
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->sitemapManager = new SitemapManager();
    }

    /**
     * @param string $name
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|AbstractFactory
     */
    private function mockFactory($name = 'demo')
    {
        $factory = $this->createMock(AbstractFactory::class);
        $factory
            ->method('getName')
            ->willReturn($name)
        ;

        return $factory;
    }
}
