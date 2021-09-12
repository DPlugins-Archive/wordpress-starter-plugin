<?php

/**
 * SubNamespaceNames
 *
 * @wordpress-plugin
 * Plugin Name:         SubNamespaceNames
 * Plugin URI:          https://yourcompanywebsite.com/subnamespacenames
 * Description:         WordPress starter plugin.
 * Version:             1.0.0
 * Requires at least:   5.8
 * Tested up to:        5.8
 * Requires PHP:        7.4
 * Author:              YourCompanyName
 * Author URI:          https://yourcompanywebsite.com
 * Text Domain:         subnamespacenames
 * Domain Path:         /languages
 *
 * @package             NamespaceName\SubNamespaceNames
 * @author              YourCompanyName <mail@yourcompanywebsite.com>
 * @link                https://yourcompanywebsite.com
 * @since               1.0.0
 * @copyright           2021 YourCompanyName
 * @version             1.0.0
 */

defined('ABSPATH') || exit;

define('SUBNAMESPACENAMES_FILE', __FILE__);

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Initialize the plugin.
 */
\NamespaceName\SubNamespaceNames\SubNamespaceNames::run('1.0.0');
