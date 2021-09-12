<?php

namespace NamespaceName\SubNamespaceNames;

/**
 * @package NamespaceName\SubNamespaceNames
 * @since 1.0.0
 * @author YourCompanyName <mail@yourcompanywebsite.com>
 * @copyright 2021 YourCompanyName
 */
class Admin
{
	public static $enqueue_styles = [];
	public static $enqueue_scripts = [];
	public static $localize_scripts = [];

	public function __construct()
	{
		add_action('admin_enqueue_scripts', function () {
			wp_register_style('subnamespacenames/admin', plugins_url('/dist/js/admin.css', SUBNAMESPACENAMES_FILE));
			wp_register_style('subnamespacenames/admin2', plugins_url('/dist/js/admin2.css', SUBNAMESPACENAMES_FILE));
			wp_register_style('subnamespacenames/admin3', plugins_url('/dist/js/admin3.css', SUBNAMESPACENAMES_FILE), [
				'subnamespacenames/admin2',
			], SubNamespaceNames::$version);
			wp_register_script('subnamespacenames/admin', plugins_url('/dist/js/admin.js', SUBNAMESPACENAMES_FILE), [], false, true);
			wp_register_script('subnamespacenames/admin2', plugins_url('/dist/js/admin2.js', SUBNAMESPACENAMES_FILE), [], false, true);
			wp_register_script('subnamespacenames/admin3', plugins_url('/dist/js/admin3.js', SUBNAMESPACENAMES_FILE), [
				'subnamespacenames/admin2',
			], SubNamespaceNames::$version, true);
		});

		add_action('admin_menu', [$this, 'admin_menu']);
	}

	public function admin_menu()
	{
		$capability = 'manage_options';

		if (current_user_can($capability)) {
			$hook = add_menu_page(
				'SubNamespaceNames',
				'SubNamespaceNames',
				$capability,
				SubNamespaceNames::$slug,
				[$this, 'admin_page_render'],
				'data:image/svg+xml;base64,' . base64_encode(@file_get_contents(dirname(SUBNAMESPACENAMES_FILE) . '/dist/img/subnamespacenames.svg')),
				100
			);

			add_action('load-' . $hook, [$this, 'init_hooks']);
		}
	}

	public function init_hooks(): void
	{
		add_action('admin_enqueue_scripts', function () {
			wp_enqueue_style('subnamespacenames/admin');
		});

	}

	public function admin_page_render()
	{
		echo '<h1>SubNamespaceNames<h1>';
	}
}
