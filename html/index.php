<?php
   /**
    * Clansuite IRC Logbot
    * Jens-André Koch © 2005 - onwards
    * http://www.clansuite.com/
    *
    * This file is part of "Clansuite IRC Logbot".
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
    * @license    GNU/GPL v2 or (at your option) any later version, see "/doc/LICENSE".
    * @author     Jens-Andre Koch <vain@clansuite.com>
    * @copyright  Jens-Andre Koch (2005 - onwards)
    * @link       http://www.clansuite.com
    *
    * @version    SVN: $Id: extract-weblinks.php 4327 2010-03-28 00:57:40Z vain $
    */

# define Clansuite Logbot Security Constant
define('IN_CSLOGBOT', true);

/**
 * fetch the header content into a output buffer
 * because in order to have unique page names (googles likes this)
 * we need to append the requested date to the html <title> tag.
 * but the date is unknown, at the time of rendering the header.
 */
ob_start();
include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'header.inc.php';
$html_output = ob_get_contents();

include dirname(__FILE__) . DIRECTORY_SEPARATOR . 'irclogs.php';

/** 
 * Append the title tag, clean the buffer, echo our now replaced header content
 */
$html_output = str_replace('<title>IRC log for ', '<title>IRC log for ' . $day_name, $html_output);
ob_clean(); 
echo $html_output;

include dirname(__FILE__) . '/footer.inc.php';
?>