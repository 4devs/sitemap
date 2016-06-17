Pagination
==========

This is a PHP paginator with a totally different core concept.

If you use Symfony 2, you could use our [sitemap bridge](https://github.com/4devs/sitemap-bridge)!
If you use Symfony 2 framework, you could use our [sitemap bundle](https://github.com/4devs/sitemap-bundle)!

## Installation
Pagination uses Composer, please checkout the [composer website](http://getcomposer.org) for more information.

The simple following command will install `sitemap` into your project. It also add a new
entry in your `composer.json` and update the `composer.lock` as well.


```bash
composer require fdevs/sitemap
```

## Usage examples:

### create your adapter

```php
<?php

namespace FDevs\App\Sitemap\Adapter;

use FDevs\Sitemap\Adapter\AbstractAdapter;

class StaticRouting extends AbstractAdapter
{
    /**
     * @param string $name
     * @param array  $params
     * @param mixed  $item
     *
     * @return Url|null
     */
    public function createUrl($name, array $params = [], $item)
    {

    }

    /**
     * @param array $params
     *
     * @return \Iterator
     */
    public function getItemList(array $params = [])
    {

    }

}

```

### usage UrlSet

```php
use FDevs\Sitemap\Factory\UrlSet;
use FDevs\Sitemap\Util\Params;

$urlset = new UrlSet();

// your params for the uri
$params = [
    ['_locale' => 'ru', '_format' => 'html'],
    ['_locale' => 'en', '_format' => 'html'],
    ['_locale' => 'ru', '_format' => 'rss'],
    ['_locale' => 'en', '_format' => 'rss'],
];

echo $urlset->xmlString($params);
//<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"><url><loc>http://4devs.io/ru</loc><priority>0.7</priority></url></urlset>

//or save sitemap
$urlset->saveFile('/full/path/to/sitemap.xml',$params);
```

### usage SiteMapIndex

```php
use FDevs\Sitemap\Factory\SiteMapIndex;

$index = new SiteMapIndex('http://domain.ltd','/full/path/to/web/dir');

// your params for the uri
$params = [
    ['_locale' => 'ru', '_format' => 'html'],
    ['_locale' => 'en', '_format' => 'html'],
];

echo $index->xmlString($params);
//<?xml version="1.0" encoding="UTF-8"?><sitemapindex><sitemap><loc>http://domain.ltd/ru.html.sitemap.xml</loc></sitemap><sitemap><loc>http://domain.ltd/en.html.sitemap.xml</loc></sitemap></sitemapindex>

//or save sitemap
$index->saveFile('/full/path/to/sitemap.xml',$params);
```

### usage Params helper

```php
use FDevs\Sitemap\Util\Params;
$params = Params::prepare(['_locale'=>['ru','en'],'_format'=>['html','xml']])
//output
/**
$params = [
    ['_locale' => 'ru', '_format' => 'html'],
    ['_locale' => 'en', '_format' => 'html'],
    ['_locale' => 'ru', '_format' => 'rss'],
    ['_locale' => 'en', '_format' => 'rss'],
];
*/
```

### usage sitemap manager

```php
use FDevs\Sitemap\SitemapManager;
use FDevs\Sitemap\Factory\SiteMapIndex;
use FDevs\Sitemap\Factory\UrlSet;
use FDevs\Sitemap\Util\Params;

$index = new SiteMapIndex('http://domain.ltd','/full/path/to/web/dir');
$urlset = new UrlSet();
$params = Params::prepare(['_locale'=>['ru','en'],'_format'=>['html','xml']])

$manager = new SitemapManager();
$manager
    ->add($urlset)
    ->add($index);

$manager->get('index')->xmlString($params);
$manager->get('index')->saveFile('/full/path/to/sitemap.xml',$params);

$manager->get('sitemap')->xmlString($params);
$manager->get('sitemap')->saveFile('/full/path/to/sitemapindex.xml',$params);

```

---
Created by [4devs](http://4devs.pro/) - Check out our [blog](http://4devs.io/) for more insight into this and other open-source projects we release.
