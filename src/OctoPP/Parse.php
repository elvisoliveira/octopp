<?php

/**
 * Parser the recieved information in order to deal with
 * the external information a proper way.
 *
 * @author     Elvis Oliveira <http://github.com/elvisoliveira>
 * @license    MIT License
 */

namespace OctoPP {

    class Parse {

        // config: extract text
        private static $text = array(
            'points' => 'p.post-meta a.point span.badge-item-love-count',
            'comments' => 'p.post-meta a.comment'
        );
        // config: extract attr
        private static $attr = array(
            'id' => array('', 'data-entry-id'),
            'next' => array('a.badge-next-post-entry', 'data-entry-key'),
            'content' => array('div.post-container img', 'src'),
            'title' => array('div.post-container img', 'alt')
        );

        /**
         * Get all the articles from the first page.
         * @return type
         */
        public static function getFirstPage() {
            // get all the articles
            $articles = htmlqp('http://9gag.com', 'article');

            $nodes = array();

            // loop the entries
            foreach ($articles as $id => $article) {
                // get information about entries
                $nodes['article'][$id] = self::getArticle($article->attr('data-entry-id'));
            }

            // return articles
            return $nodes;
        }

        /**
         * Get the parameters from the original source page.
         * @param string $id
         * @return array
         */
        public static function getArticle($id) {
            // get node from original page
            $article = htmlqp("http://9gag.com/gag/{$id}", "article");

            // get and store all information about that single article
            foreach (self::$text as $id => $row) {
                // set params as a node
                $node[$id] = trim(qp($article)->find($row)->text());
            }

            // get and store all information about that single article
            foreach (self::$attr as $id => $row) {
                // set params as a node

                if (empty($row[0])) {
                    $node[$id] = qp($article)->attr($row[1]);
                } else {
                    $node[$id] = qp($article)->find($row[0])->attr($row[1]);
                }
            }

            return $node;
        }

    }

}