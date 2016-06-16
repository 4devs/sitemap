<?php

namespace FDevs\Sitemap\Adapter;

interface AdapterInterface
{
    /**
     * @param array $params
     *
     * @return UrlIteratorInterface
     */
    public function getUrlList(array $params = []);
}
