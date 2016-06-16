<?php

namespace FDevs\Sitemap\Model;

use FDevs\Sitemap\ElementInterface;

class SiteMap extends AbstractElement
{
    /**
     * @var ElementInterface[]
     */
    protected $elements = [];

    /**
     * SiteMap constructor.
     *
     * @param Loc|string $loc
     */
    public function __construct($loc)
    {
        if (is_string($loc)) {
            $loc = new Loc($loc);
        }
        $this->setLoc($loc);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'sitemap';
    }

    /**
     * @param LastModification|\DateTime $lastModification
     *
     * @return $this
     */
    public function setLastModification($lastModification)
    {
        if ($lastModification instanceof \DateTime) {
            $lastModification = new LastModification($lastModification);
        }
        $this->elements[self::ELEMENT_LASTMOD] = $lastModification;

        return $this;
    }

    public function setLoc(Loc $loc)
    {
        $this->elements[self::ELEMENT_LOC] = $loc;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return array_values($this->elements);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttr()
    {
        return [];
    }
}
