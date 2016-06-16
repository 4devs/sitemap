<?php

namespace FDevs\Sitemap\Adapter;

use FDevs\Sitemap\Model\Url;

interface UrlIteratorInterface extends \Iterator
{
    /**
     * @return Url|null
     */
    public function current();
}
