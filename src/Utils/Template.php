<?php

namespace NamespaceName\SubNamespaceNames\Utils;

use Exception;
use League\Plates\Engine;

/**
 * @package NamespaceName\SubNamespaceNames
 * @since 1.0.0
 * @author YourCompanyName <mail@yourcompanywebsite.com>
 * @copyright 2021 YourCompanyName
 */
class Template
{
    private static $instances = [];

    public static $templates;

    protected function __construct()
    {
        self::$templates = new Engine(dirname(SUBNAMESPACENAMES_FILE) . '/templates');

        self::$templates->registerFunction('asset', fn ($string) => plugins_url("/dist/{$string}", SUBNAMESPACENAMES_FILE));
    }

    public static function getInstance(): Template
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

    public static function __callStatic(string $method, array $args)
    {
        return self::getInstance()::$templates->{$method}(...$args);
    }

    public function __get(string $name)
    {
        return self::getInstance()::$templates->{$name};
    }

    public function __wakeup()
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    protected function __clone()
    {
    }

    public static function template(): Engine
    {
        return self::getInstance()::$templates;
    }
}
