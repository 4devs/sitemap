<?php

namespace FDevs\Sitemap\Tests\Factory;

use FDevs\Sitemap\Factory\AbstractFactory;
use org\bovigo\vfs\vfsStreamContainer;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use org\bovigo\vfs\vfsStreamWrapper;
use PHPUnit\Framework\TestCase;

abstract class FactoryTestCase extends TestCase
{
    /**
     * @var vfsStreamContainer
     */
    private $fsRoot;

    /**
     * @var vfsStreamDirectory
     */
    private $fsRootDir;

    /**
     * @return array
     */
    abstract public function getXmlStringProvider();

    /**
     * @param array $params
     *
     * @return AbstractFactory
     */
    abstract protected function getFactory(array $params = []);

    public function testGetNameShouldReturnString()
    {
        $this->assertInternalType('string', $this->getFactory()->getName());
    }

    /**
     * @dataProvider getXmlStringProvider
     *
     * @param array  $params
     * @param string $expectedXml
     */
    public function testXmlStringShouldReturnExactString(array $params, $expectedXml)
    {
        $xml = $this->getFactory($params)->xmlString($params);

        $this->assertInternalType('string', $xml);
        $this->assertEquals($expectedXml, $xml);
    }

    public function testSaveFileShouldReturnSelf()
    {
        $factory = $this->getFactory();

        $this->assertEquals($factory, $factory->saveFile($this->relativeToVirtualPath('test-file.xml')));
    }

    /**
     * @depends testXmlStringShouldReturnExactString
     * @dataProvider getXmlStringProvider
     *
     * @param array  $params
     * @param string $expectedContent
     */
    public function testSaveFileShouldActuallyCreateAFileWithContent(array $params, $expectedContent)
    {
        $factory = $this->getFactory($params);
        $fileName = mt_rand(0, 10000).'xml';

        $this->assertFalse($this->fsRoot->hasChild($fileName));

        $factory->saveFile($this->relativeToVirtualPath($fileName), $params);
        $this->assertTrue($this->fsRoot->hasChild($fileName));

        $file = $this->fsRoot->getChild($fileName);

        if ($file instanceof vfsStreamFile) {
            $this->assertEquals($expectedContent, $file->getContent());
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        vfsStreamWrapper::register();
        $this->fsRootDir = new vfsStreamDirectory('demo');
        $this->fsRoot = vfsStreamWrapper::setRoot($this->fsRootDir);
    }

    /**
     * @return vfsStreamDirectory
     */
    protected function getFsRootDir()
    {
        return $this->fsRootDir;
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    protected function relativeToVirtualPath($fileName)
    {
        return $this->fsRootDir->url().DIRECTORY_SEPARATOR.$fileName;
    }
}
