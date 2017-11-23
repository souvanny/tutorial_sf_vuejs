<?php

namespace AppBundle\Library;

use Symfony\Component\DependencyInjection\Container;

class StringUtils
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
     * @param string $label
     *
     * @return bool
     */
    public function isValidEntityLabel($label)
    {
        return (bool)preg_match('/^-?([a-z0-9_]+-?)+$/', $label);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function isValidEntityName($name)
    {
        return (bool)preg_match('/^[\p{L}a-z0-9 _-]+$/ui', $name);
    }

    /**
     * @param $email
     *
     * @return bool
     */
    public function isValidEmail($email)
    {
        return (bool)preg_match("/^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/", $email);
    }

    /**
     * @param $string
     *
     * @return bool
     */
    public function isValidHexadecimal($string)
    {
        return (bool)preg_match("/#([a-fA-F0-9]){3}(([a-fA-F0-9]){3})?\b/", $string);
    }

    /**
     * @param string $content
     * @param string $separator
     *
     * @return mixed
     */
    public function uncamel($content, $separator = '_')
    {
        $content = preg_replace_callback(
            '#(?<=[a-zA-Z])([A-Z])(?=[a-zA-Z])#',
            function ($m) use ($separator) {
                return $separator . strtolower($m[1]);
            },
            $content
        );
        $content{0} = strtolower($content{0});

        return $content;
    }

}
