<?php

namespace FDevs\Sitemap\Tests\Model;

use FDevs\Sitemap\ElementInterface;
use FDevs\Sitemap\Model\AbstractElement;
use PHPUnit\Framework\TestCase;

class AbstractElementTest extends TestCase
{
    /**
     * @var AbstractElement
     */
    private $element;

    /**
     * @return array
     */
    public function getNamespaces()
    {
        return [
            'empty namespaces' => [
                'namespaces' => [],
                'expected' => [],
            ],
            'different namespaces' => [
                'namespaces' => [
                    ['namespace1', 'path1'],
                    ['namespace2', 'path2'],
                ],
                'expected' => [
                    'namespace1' => 'path1',
                    'namespace2' => 'path2',
                ],
            ],
            'has duplicated namespaces' => [
                'namespaces' => [
                    ['namespace1', 'path1'],
                    ['namespace2', 'path2'],
                    ['namespace1', 'new path1'],
                ],
                'expected' => [
                    'namespace1' => 'new path1',
                    'namespace2' => 'path2',
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getValue()
    {
        return [
            ['test namespace'],
            [null],
        ];
    }

    /**
     * @return array
     */
    public function getNestedNamespaces()
    {
        return [
            'merge namespaces' => [
                'nested',
                'nested/path',
                'own',
                'own/path',
                [
                    'nested' => 'nested/path',
                    'own' => 'own/path',
                ],
            ],
            'own namespaces override the nested ones' => [
                'nested namespace' => 'namespace',
                'nested/path',
                'own namespace' => 'namespace',
                'own/path',
                [
                    'namespace' => 'own/path',
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    public function getStringRepresentation()
    {
        return [
            'empty attrs and empty value' => [
                'attrs' => [],
                'value' => [],
                'name' => 'sitemap',
                'expected' => '<sitemap/>',
            ],
            'empty attrs and string value' => [
                'attrs' => [],
                'value' => '<test-tag/>',
                'name' => 'sitemap',
                'expected' => '<sitemap><test-tag/></sitemap>',
            ],
            'empty attrs and nested values' => [
                'attrs' => [],
                'value' => [$this->createElementStub('test-tag'), $this->createElementStub('test-tag-2')],
                'name' => 'sitemap',
                'expected' => '<sitemap><test-tag/><test-tag-2/></sitemap>',
            ],
            'many attrs and empty value' => [
                'attrs' => ['created-at' => '11.12.2015', 'last-modified' => '12.12.2015'],
                'value' => [],
                'name' => 'sitemap',
                'expected' => '<sitemap created-at="11.12.2015" last-modified="12.12.2015"/>',
            ],
            'many attrs and string value' => [
                'attrs' => ['created-at' => '11.12.2015', 'last-modified' => '12.12.2015'],
                'value' => '<test-tag/>',
                'name' => 'sitemap',
                'expected' => '<sitemap created-at="11.12.2015" last-modified="12.12.2015"><test-tag/></sitemap>',
            ],
            'many attrs and nested values' => [
                'attrs' => ['created-at' => '11.12.2015', 'last-modified' => '12.12.2015'],
                'value' => [$this->createElementStub('test-tag'), $this->createElementStub('test-tag-2')],
                'name' => 'sitemap',
                'expected' => '<sitemap created-at="11.12.2015" last-modified="12.12.2015"><test-tag/><test-tag-2/></sitemap>',
            ],
        ];
    }

    public function testMustImplementElementInterface()
    {
        $this->assertInstanceOf(ElementInterface::class, $this->element);
    }

    public function testAddNamespaceMustReturnSelf()
    {
        $this->assertEquals($this->element, $this->element->addNamespace('test name', '/test/path'));
    }

    /**
     * @dataProvider getNamespaces
     *
     * @param array $namespaces
     * @param array $expectedNamespaces
     */
    public function testAddAndGetNamespaceShouldWorkTogether(array $namespaces, array $expectedNamespaces)
    {
        foreach ($namespaces as $namePath) {
            $this->element->addNamespace($namePath[0], $namePath[1]);
        }

        $this->assertEquals($expectedNamespaces, $this->element->getNamespace());
    }

    /**
     * @dataProvider getValue
     *
     * @param mixed $value
     */
    public function testGetNamespaceShouldIgnoreNotArraysFromGetValue($value)
    {
        $this
            ->element
            ->expects($this->once())
            ->method('getValue')
            ->willReturn($value)
        ;

        $this->assertEquals([], $this->element->getNamespace());
    }

    /**
     * @depends testAddAndGetNamespaceShouldWorkTogether
     * @dataProvider getNestedNamespaces
     *
     * @param string $nestedNamespace
     * @param string $nestedPath
     * @param string $ownNamespace
     * @param string $ownPath
     * @param array  $expected
     */
    public function testGetNamespaceShouldHonorNamespacesOfNestedElements($nestedNamespace, $nestedPath, $ownNamespace, $ownPath, array $expected)
    {
        /** @var AbstractElement $nestedElement */
        $nestedElement = $this->getMockForAbstractClass(AbstractElement::class);
        $nestedElement->addNamespace($nestedNamespace, $nestedPath);

        $this
            ->element
            ->expects($this->once())
            ->method('getValue')
            ->willReturn([$nestedElement])
        ;

        $this->element->addNamespace($ownNamespace, $ownPath);
        $this->assertEquals($expected, $this->element->getNamespace());
    }

    /**
     * @dataProvider getStringRepresentation
     *
     * @param array        $attrs
     * @param array|string $value
     * @param string       $name
     * @param string       $expected
     */
    public function testToString(array $attrs, $value, $name, $expected)
    {
        $this
            ->element
            ->expects($this->once())
            ->method('getAttr')
            ->willReturn($attrs)
        ;

        $this
            ->element
            ->expects($this->once())
            ->method('getValue')
            ->willReturn($value)
        ;
        $this
            ->element
            ->expects($this->once())
            ->method('getName')
            ->willReturn($name)
        ;

        $this->assertEquals($expected, $this->element->__toString());
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->element = $this->getMockForAbstractClass(AbstractElement::class);
    }

    /**
     * @param string      $name
     * @param array       $attrs
     * @param null|string $value
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function createElementStub($name, array $attrs = [], $value = null)
    {
        $element = $this->getMockForAbstractClass(AbstractElement::class);
        $element
            ->method('getAttr')
            ->willReturn($attrs)
        ;
        $element
            ->method('getValue')
            ->willReturn($value)
        ;
        $element
            ->method('getName')
            ->willReturn($name)
        ;

        return $element;
    }
}
