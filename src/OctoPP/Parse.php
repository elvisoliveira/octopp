<?php

namespace OctoPP {
    /**
     * Parser the recieved information in order to deal with
     * the external information a proper way.
     *
     * @author     Elvis Oliveira <http://github.com/elvisoliveira>
     * @license    MIT License
     */
    class Parse {
        public static function getFirstPage() {
            // URL to fetch:
            $url = 'http://9gag.com';
            return htmlqp($url, 'title')->text();
            
        }
        public static function getArticle() {
            
        }
    }
}