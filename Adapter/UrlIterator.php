<?php

namespace FDevs\Sitemap\Adapter;

class UrlIterator implements UrlIteratorInterface
{
    /**
     * @var AbstractAdapter
     */
    private $adapter;

    /**
     * @var \Iterator
     */
    private $items;

    /**
     * @var array
     */
    private $params;

    /**
     * UrlIterator constructor.
     *
     * @param \Iterator       $items
     * @param array           $params
     * @param AbstractAdapter $adapter
     */
    public function __construct(\Iterator $items, array $params, AbstractAdapter $adapter)
    {
        $this->items = $items;
        $this->params = $params;
        $this->adapter = $adapter;
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->items->next();
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->items->key();
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return $this->items->valid();
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->items->rewind();
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        $item = $this->items->current();

        return $this->adapter->isGranted($item, $this->params) ? $this->adapter->createUrl($this->key(), $this->params, $item) : null;
    }
}
