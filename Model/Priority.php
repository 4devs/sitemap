<?php

namespace FDevs\Sitemap\Model;

class Priority extends AbstractElement
{
    /**
     * @var float
     */
    protected $priority = 0.5;

    /**
     * Priority constructor.
     *
     * @param float $priority
     */
    public function __construct($priority = 0.5)
    {
        $this->priority = floatval($priority);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::ELEMENT_PRIORITY;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->priority;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttr()
    {
        return [];
    }
}
