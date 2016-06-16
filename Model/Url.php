<?php

namespace FDevs\Sitemap\Model;

use FDevs\Sitemap\ElementInterface;

class Url extends AbstractElement
{
    /**
     * @var ElementInterface[]
     */
    private $elements = [];

    /**
     * @var array
     */
    private $uniqueList = [self::ELEMENT_LOC, self::ELEMENT_PRIORITY, self::ELEMENT_LASTMOD, self::ELEMENT_CHANGEFREQ];

    /**
     * Url constructor.
     *
     * @param string|ElementInterface $loc
     */
    public function __construct($loc)
    {
        $this->setLoc($loc);
    }

    /**
     * @param string|Loc $loc
     *
     * @return $this
     */
    public function setLoc($loc)
    {
        if (is_string($loc)) {
            $loc = new Loc($loc);
        }
        $this->elements[self::ELEMENT_LOC] = $loc;

        return $this;
    }

    /**
     * @param float|Priority $priority
     *
     * @return $this
     */
    public function setPriority($priority)
    {
        if (!$priority instanceof Priority) {
            $priority = new Priority(floatval($priority));
        }
        $this->elements[self::ELEMENT_PRIORITY] = $priority;

        return $this;
    }

    /**
     * @param string|ChangeFrequency $freq
     *
     * @return $this
     */
    public function setChangeFreq($freq)
    {
        if (!$freq instanceof ChangeFrequency) {
            $freq = new ChangeFrequency(strval($freq));
        }
        $this->elements[self::ELEMENT_CHANGEFREQ] = $freq;

        return $this;
    }

    /**
     * @param \DateTime|LastModification $lastMod
     *
     * @return $this
     */
    public function setLastMod($lastMod)
    {
        if ($lastMod instanceof \DateTime) {
            $lastMod = new LastModification($lastMod);
        }
        $this->elements[self::ELEMENT_LASTMOD] = $lastMod;

        return $this;
    }

    /**
     * @return null|\DateTime
     */
    public function getLastMod()
    {
        return isset($this->elements[self::ELEMENT_LASTMOD]) ? $this->elements[self::ELEMENT_LASTMOD]->getDate() : null;
    }

    /**
     * @param AbstractElement $element
     *
     * @return $this
     */
    public function addElement(AbstractElement $element)
    {
        $name = $element->getName();
        if (in_array($name, $this->uniqueList)) {
            $this->elements[$name] = $element;
        } else {
            $this->elements[] = $element;
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'url';
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
