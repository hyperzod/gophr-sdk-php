<?php

namespace Hyperzod\GophrSdkPhp\Service;

/**
 * Service factory class for API resources in the root namespace.
 *
 */
class CoreServiceFactory extends AbstractServiceFactory
{
    /**
     * @var array<string, string>
     */
    private static $classMap = [];

    protected function getServiceClass($name)
    {
        return \array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;
    }
}
