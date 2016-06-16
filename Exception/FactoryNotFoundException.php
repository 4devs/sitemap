<?php

namespace FDevs\Sitemap\Exception;

class FactoryNotFoundException extends Exception
{
    /**
     * {@inheritdoc}
     */
    public function __construct($name, $code = 0, \Exception $previous = null)
    {
        parent::__construct(sprintf('factory with name %s not found', $name), $code, $previous);
    }
}
