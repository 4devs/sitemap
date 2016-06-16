<?php

namespace FDevs\Sitemap\Model;

class LastModification extends AbstractElement
{
    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * LastModification constructor.
     *
     * @param \DateTime $date
     */
    public function __construct(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::ELEMENT_LASTMOD;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->date->format('Y-m-d');
    }

    /**
     * {@inheritdoc}
     */
    public function getAttr()
    {
        return [];
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
