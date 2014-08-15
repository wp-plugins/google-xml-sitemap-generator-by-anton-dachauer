<?php
/**
 * Google XML Sitemap Generator by Anton Dachauer
 * Written by Anton Dachauer (http://antondachauer.de)
 */

if (!function_exists('ADgetTagBase')) {
    function ADgetTagBase() {
        global $wpdb;

        $row = $wpdb->get_row($wpdb->prepare("SELECT option_value FROM $wpdb->options WHERE option_name = %s LIMIT 1", "tag_base"));

        if (strlen($row->option_value) > 0) {
            return $row->option_value;
        }

        return 'tag';
    }
}

if (!function_exists('ADgetCategoryBase')) {
    function ADgetCategoryBase() {
        global $wpdb;

        $row = $wpdb->get_row($wpdb->prepare("SELECT option_value FROM $wpdb->options WHERE option_name = %s LIMIT 1", "category_base"));

        if (strlen($row->option_value) > 0) {
            return $row->option_value;
        }

        return 'category';
    }
}
