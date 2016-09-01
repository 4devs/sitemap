<?php

namespace FDevs\Sitemap\Tests\Model;

/**
 * Use only in TestCase and AbstractElement context.
 */
trait EmptyAttributesTrait
{
    public function testElementCanNotHaveAttributes()
    {
        $this->assertEquals([], $this->element->getAttr());
    }
}
