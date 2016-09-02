<?php

namespace FDevs\Sitemap\Tests\Model;

/**
 * Use only in TestCase and AbstractElement context.
 */
trait GetNameReturnsStringTrait
{
    public function testGetNameShouldReturnString()
    {
        $this->assertInternalType('string', $this->element->getName());
    }
}
