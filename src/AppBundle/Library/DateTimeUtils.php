<?php

namespace AppBundle\Library;

use Symfony\Component\DependencyInjection\Container;

class DateTimeUtils
{
    /**
     * @var Container
     */
    private $container;

    /**
     * constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $format
     * @param string $string
     *
     * @return bool
     */
    public function isValidDateTime($format, $string)
    {
        $date = \DateTime::createFromFormat($format, $string);

        if ($date instanceof \DateTime) {
            $dateTimestamp = $date->getTimestamp();
            $stringToCheck = date($format, $dateTimestamp);

            return $string === $stringToCheck;
        } else {
            return false;
        }
    }
}
