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
        /**
         * Get all the articles from the first page.
         * @return array
         */
        public static function getFirstPage() {
            // get all the articles
            $articles = htmlqp('http://9gag.com', 'article');
            // loop the entries
            foreach($articles as $id => $article) {
                $nodes[$id] = self::getArticle($article->attr('data-entry-id'));
            }
            
            return $nodes;
            
        }
        /**
         */
        public static function getArticle($id) {
            // get node from original page
            $article = htmlqp("http://9gag.com/gag/{$id}", "article");
            
            // get and store all information about that single article
            $node['id'] = trim(qp($article)->attr('data-entry-id')); # id
            $node['points'] = trim(qp($article)->find('p.post-meta a.point span.badge-item-love-count')->text()); # points
            $node['comments'] = trim(qp($article)->find('p.post-meta a.comment')->text()); # comments
            $node['next'] = trim(qp($article)->find('a.badge-next-post-entry')->attr('data-entry-key')); # next ID
            $node['image'] = trim(qp($article)->find('div.post-container img')->attr('src')); # image URL
            
            return $node;
        }
    }
}