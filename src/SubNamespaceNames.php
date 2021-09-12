<?php

namespace NamespaceName\SubNamespaceNames;

use NamespaceName\SubNamespaceNames\Utils\Utils;

/**
 * @package NamespaceName\SubNamespaceNames
 * @since 1.0.0
 * @author YourCompanyName <mail@yourcompanywebsite.com>
 * @copyright 2021 YourCompanyName
 */
class SubNamespaceNames
{
    public static $version;
    public static $slug = 'subnamespacenames';

    public static $updater;

    public function __construct($version)
    {
        self::$version = $version;

        register_activation_hook(SUBNAMESPACENAMES_FILE, [$this, 'plugin_activate']);
        register_deactivation_hook(SUBNAMESPACENAMES_FILE, [$this, 'plugin_deactivate']);

        self::$updater = new PluginUpdater(self::$slug, [
            'version'     => self::$version,
            'license'     => Utils::get_option("_license_key"),
            'beta'        => Utils::get_option("_beta"),
            'plugin_file' => SUBNAMESPACENAMES_FILE,
            'item_id'     => 9,
            'store_url'   => 'https://yourcompanywebsite.com',
            'author'      => 'YourCompanyName',
            'is_require_license' => false,
        ]);

        new Admin;

        add_action('init', [$this, 'init']);

        add_filter('plugin_action_links_' . plugin_basename(SUBNAMESPACENAMES_FILE), function ($links) {
            return Utils::plugin_action_links($links);
        });
    }

    public function init()
    {
        // self::plugin_update();
    }

    protected static function plugin_update()
    {
        if (self::$updater->isActivated()) {
            $doing_cron = defined('DOING_CRON') && DOING_CRON;
            if (!(current_user_can('manage_options') && $doing_cron)) {
                self::$updater->ignite();
            }
        }
    }

    public static function run($version)
    {
        static $instance = false;

        if (!$instance) {
            $instance = new SubNamespaceNames($version);
        }

        return $instance;
    }

    public function plugin_activate()
    {
    }
    public function plugin_deactivate()
    {
    }
}
