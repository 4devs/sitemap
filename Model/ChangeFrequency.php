<?php

namespace FDevs\Sitemap\Model;

class ChangeFrequency extends AbstractElement
{
    const ALWAYS = 'always';
    const HOURLY = 'hourly';
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';
    const NEVER = 'never';

    /**
     * @var string
     */
    protected $frequency;

    /**
     * ChangeFrequency constructor.
     *
     * @param string $frequency
     */
    public function __construct($frequency = self::WEEKLY)
    {
        $this->frequency = $frequency;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::ELEMENT_CHANGEFREQ;
    }

    /**
     * @param string $frequency
     *
     * @return ChangeFrequency
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->frequency;
    }

    /**
     * {@inheritdoc}
     */
    public function getAttr()
    {
        return [];
    }
}
