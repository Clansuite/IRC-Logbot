<?php
   /**
    * Clansuite IRC Logbot
    * Jens-André Koch © 2005 - onwards
    * http://www.clansuite.com/
    *
    * This file is part of "Clansuite - just an eSports CMS".
    *
    * LICENSE:
    *
    *    This program is free software; you can redistribute it and/or modify
    *    it under the terms of the GNU General Public License as published by
    *    the Free Software Foundation; either version 2 of the License, or
    *    (at your option) any later version.
    *
    *    This program is distributed in the hope that it will be useful,
    *    but WITHOUT ANY WARRANTY; without even the implied warranty of
    *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    *    GNU General Public License for more details.
    *
    *    You should have received a copy of the GNU General Public License
    *    along with this program; if not, write to the Free Software
    *    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
    *
    */

// Security Handler
if (!defined('IN_CSLOGBOT')){ die('Clansuite not loaded. Direct Access forbidden.'); }

/**
 * Linkgrabber - extracts HTML links.
 */
class LinkGrabber
{
    /**
     * Contains the extracted links
     *
     * @var $links array
     */
    public $links = array();

    /**
     * grabLinks - Extract links from html using domdocument.
     *
     * @param string   $link  url ressource string (set load true) or html string
     * @param boolean  $load  when true, will grab the html content from url ressource string provided by $link
     * @param boolean  $return set links to class, or return directly
     */
    public function grabLinks($link, $load = null, $return = null)
    {
        $links_array = array();
        $dom = new domDocument;

        // get the HTML with error suppresion active, because html soup can contain invalid cdata entities
        if($load === true) {
            // load html content from a URL resource
            @$dom->loadHTML(file_get_contents($link));
        } else {
            @$dom->loadHTML($link);
        }
        
        // remove silly white space
        $dom->preserveWhiteSpace = false;

        // get the links from the HTML
        $links = $dom->getElementsByTagName('a');

        // loop over all links
        foreach ($links as $tag) {
            $links_array[$tag->getAttribute('href')] = $tag->childNodes->item(0)->nodeValue;
        }

        if($return === true) {
            return $links_array;
        } else {
            $this->links = array_merge($links_array, $this->links);
        }
    }

    /**
     * displayListOfLinks
     */
    public function displayListOfLinks()
    {
        // check for results
        if(count($this->links) > 0) {
            $i = 0;

            // and list each one
            foreach($this->links as $key => $value) {
                ++$i;
                echo '<b>'.$i.'</b>) <a href="'.$key.'">'.$value .'</a><br />';
            }
        } else {
            echo "No links found.";
        }
    }
}
