<?php

namespace FDevs\Sitemap\Model;

class Loc extends AbstractElement
{
    /**
     * @var string
     */
    protected $value;

    /**
     * Loc constructor.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::ELEMENT_LOC;
    }

    /**
     * @param string $value
     *
     * @return Loc
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttr()
    {
        return [];
    }
}
