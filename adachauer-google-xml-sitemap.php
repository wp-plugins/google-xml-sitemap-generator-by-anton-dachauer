<?php

/**
 * Plugin Name: Google XML Sitemap Generator by Webworks Nuernberg
 * Plugin URI: http://www.webworks-nuernberg.de/google-xml-sitemap-generator-fuer-wordpress/
 * Description: Generates a XML Sitemap for Google and other search engines.
 * Version: 1.0.4
 * Author: adachauer
 * Author URI: http://www.webworks-nuernberg.de/
 * License: GPL2
 */

/*  Copyright 2014  Anton Dachauer/Webworks Nürnberg  (email : kontakt@webworks-nuernberg.de)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!defined('ABSPATH')) {
    die("No direct access please!");
};

if (!defined('AD_PLUGIN_DIR_NAME')) {
    define('AD_PLUGIN_DIR_NAME', basename(__DIR__));
}

require_once __DIR__. DIRECTORY_SEPARATOR. 'wp_helper.php';
require_once __DIR__. DIRECTORY_SEPARATOR. 'plugin.php';

if (function_exists('ADSetupSitemapPlugin')) {
    ADSetupSitemapPlugin();
}
