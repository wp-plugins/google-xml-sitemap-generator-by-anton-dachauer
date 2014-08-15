<?php
/**
 * Google XML Sitemap Generator by Anton Dachauer
 * Written by Anton Dachauer (http://antondachauer.de)
 */

/**
 * Init-Funktion for the Plugin
 */
function ADSetupSitemapPlugin() {
    if (!class_exists('ADSitemapPlugin')) {
        require_once __DIR__. DIRECTORY_SEPARATOR. 'lib'. DIRECTORY_SEPARATOR. 'sitemap.php';

        $sitemap = new ADSitemapPlugin();
    }
}
