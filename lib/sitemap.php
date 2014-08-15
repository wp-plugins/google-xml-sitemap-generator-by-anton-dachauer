<?php
/**
 * Google Sitemap Plugin for Wordpress, written by Anton Dachauer (http://antondachauer.de)
 */

class ADSitemapPlugin {

    const MAX_ITEMS_COUNT = 50000;
    private $_itemsCount = 0;

    public function __construct() {
        if ($this->isSitemapCalled()) {
            $this->outputSitemap();
        }
    }

    private function isSitemapCalled() {
        if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI'] == '/sitemap.xml') {
            return true;
        }

        return false;
    }

    private function getPosts() {
        $posts = get_posts(array(
            'numberposts'       => 99999999999,
        ));

        return $posts;
    }

    private function getPages() {
        $pages = get_pages();

        return $pages;
    }

    private function getComments() {
        $comments = get_comments();

        return $comments;
    }

    private function getXMLHead() {
        $url = get_bloginfo('url');
        $xml = '<?xml version="1.0" encoding="UTF-8"?>
            <?xml-stylesheet type="text/xsl" href="'. $url. '/wp-content/plugins/'. AD_PLUGIN_DIR_NAME. '/template/xml-sitemap.xsl" ?>
            <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        return $xml;
    }

    private function getXMLFoot() {
        $xml = '</urlset>';
        return $xml;
    }

    private function setHeader() {
        header('Content-Type: application/xml');
    }

    private function generateSitemapEntriesForPosts() {
        $posts = $this->getPosts();

        $urls = array();
        if (sizeof($posts) > 0) {
            foreach ($posts as $key => $post) {
                if ($post->post_status == 'publish' && $this->_itemsCount < self::MAX_ITEMS_COUNT) {
                    $item = array(
                        'loc'               => $post->post_name,
                        'lastmod'           => $post->post_modified,
                        'changefreq'        => 'daily',
                        'priority'          => '0.6',
                    );
                    $urls[] = $item;

                    $this->_itemsCount++;
                }
            }
        }

        return $urls;
    }

    private function generateSitemapEntriesForPages() {
        $pages = $this->getPages();

        $urls = array();
        if (sizeof($pages) > 0) {
            foreach ($pages as $key => $page) {
                if ($page->post_status == 'publish' && $this->_itemsCount < self::MAX_ITEMS_COUNT) {
                    $item = array(
                        'loc'               => $page->post_name,
                        'lastmod'           => $page->post_modified,
                        'changefreq'        => 'daily',
                        'priority'          => '0.8',
                    );
                    $urls[] = $item;

                    $this->_itemsCount++;
                }
            }
        }

        return $urls;
    }

    private function generateSitemapEntries() {
        $postUrls = $this->generateSitemapEntriesForPages();
        $pageUrls = $this->generateSitemapEntriesForPosts();
        return array_merge($postUrls, $pageUrls);
    }

    private function generateSitemapItemsXML() {
        $items = $this->generateSitemapEntries();

        $xml = "";
        $xml .= "<url>
                    <loc>/</loc>
                    <lastmod>". date('Y-m-d H:i'). "</lastmod>
                    <changefreq>hourly</changefreq>
                    <priority>1.0</priority>
                </url>";
        if (sizeof($items) > 0) {
            foreach ($items as $item) {
                $xml .= "<url>
                    <loc>". $item['loc']. "</loc>
                    <lastmod>". $item['lastmod']. "</lastmod>
                    <changefreq>". $item['changefreq']. "</changefreq>
                    <priority>". $item['priority']. "</priority>
                </url>";
            }
        }

        return $xml;
    }

    private function outputSitemap() {
        $this->setHeader();

        echo $this->getXMLHead();
        echo $this->generateSitemapItemsXML();
        echo $this->getXMLFoot();

        die();
    }
}
