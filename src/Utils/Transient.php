<?php

namespace NamespaceName\SubNamespaceNames\Utils;

use Closure;

/**
 * @package NamespaceName\SubNamespaceNames
 * @since 1.0.0
 * @author YourCompanyName <mail@yourcompanywebsite.com>
 * @copyright 2021 YourCompanyName
 */
class Transient
{
	public static function has($key): bool
	{
		return get_transient($key) !== false ? true : false;
	}

	public static function get($key, $default = false)
	{
		return get_transient($key, $default);
	}

	public static function set($key, $value = null, $ttl = 0)
	{
		if (is_array($key)) {
			foreach ($key as $k => $v) {
				if (!is_array($v)) {
					self::set($k, $v, $ttl);
				} else {
					self::set($k, $v[0], $v[1]);
				}
			}
			return;
		}

		set_transient($key, $value, $ttl);
	}

	public static function delete($key)
	{
		return delete_transient($key);
	}

	public static function remember($key, $ttl, Closure $callback)
	{
		$item = self::get($key);

		if ($item !== false) {
			return $item;
		}

		self::set($key, $item = $callback(), $ttl);

		return $item;
	}
}
