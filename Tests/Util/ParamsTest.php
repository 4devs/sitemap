<?php

namespace FDevs\Tests\Util;

use FDevs\Sitemap\Util\Params;
use PHPUnit\Framework\TestCase;

class ParamsTest extends TestCase
{
    /**
     * @return array
     */
    public function getParamsProvider()
    {
        return [
            'empty params' => [
                // params, expected result
                [],
                [
                    [],
                ],
            ],
            'transformation' => [
                [
                    'locale' => ['ru'],
                ],
                [
                    ['locale' => 'ru'],
                ],
            ],
            'combinations' => [
                ['locale' => ['ru', 'en'], 'format' => ['html', 'xml']],
                [
                    ['locale' => 'ru', 'format' => 'html'],
                    ['locale' => 'en', 'format' => 'html'],
                    ['locale' => 'ru', 'format' => 'xml'],
                    ['locale' => 'en', 'format' => 'xml'],
                ],
            ],
        ];
    }

    /**
     * @dataProvider getParamsProvider
     *
     * @param array $params
     * @param array $expected
     */
    public function testPrepareShouldUnwindParams(array $params, array $expected)
    {
        $this->assertEquals($expected, Params::prepare($params));
    }
}
