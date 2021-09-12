<?php

namespace NamespaceName\SubNamespaceNames\Utils;

use NamespaceName\SubNamespaceNames\SubNamespaceNames;
use League\Plates\Engine;
use Medoo\Medoo;

/**
 * @package NamespaceName\SubNamespaceNames
 * @since 1.0.0
 * @author YourCompanyName <mail@yourcompanywebsite.com>
 * @copyright 2021 YourCompanyName
 */
class Utils
{
	public static function db(): Medoo
	{
		return DB::db();
	}

	public static function template(): Engine
	{
		return Template::template();
	}

	public static function get_option($option, $default = false)
	{
		return \get_option(SubNamespaceNames::$slug . '_' . $option, $default);
	}

	public static function update_option($option, $value, $autoload = null)
	{
		return \update_option(SubNamespaceNames::$slug . '_' . $option, $value);
	}

	public static function delete_option($option)
	{
		return \delete_option(SubNamespaceNames::$slug . '_' . $option);
	}

	public static function redirect($location)
	{
		if (headers_sent() === false) {
			wp_redirect($location);
		} else {
			echo '<meta http-equiv="refresh" content="0;url=' . $location . '">';
		}
		exit;
	}

	public static function is_request(string $type): bool
	{
		switch ($type) {
			case 'admin':
				return is_admin();
			case 'ajax':
				return defined('DOING_AJAX');
			case 'rest':
				return defined('REST_REQUEST');
			case 'cron':
				return defined('DOING_CRON');
			case 'frontend':
				return (!is_admin() || defined('DOING_AJAX')) && !defined('DOING_CRON');
			default:
				return false;
				break;
		}
	}

	public static function plugin_action_links($links)
	{
		$plugin_shortcuts = [
			'<a href="' . add_query_arg(['page' => SubNamespaceNames::$slug, 'route' => 'modules'], admin_url('admin.php')) . '"> Modules </a>',
		];

		return array_merge($links, $plugin_shortcuts);
	}
}
