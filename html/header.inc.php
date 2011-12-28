<?php
   /**
    * Clansuite - just an eSports CMS
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
    * @author     Jens-André Koch <vain@clansuite.com>
    * @copyright  Jens-André Koch (2005 - onwards)
    * @link       http://www.clansuite.com
    *
    * @version    SVN: $Id: extract-weblinks.php 4327 2010-03-28 00:57:40Z vain $
    */

# Security Handler
if(defined('IN_CSLOGBOT') === false)
{
    die('Clansuite Logbot not loaded. Direct Access forbidden.');
}
include dirname(__FILE__) . '/config.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />

        <title><?php echo("IRC Log for $channel on $server, collected by $nick"); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="IRC Log for <?php echo($channel); ?>" />
        <meta name="keywords" content="IRC Log for <?php echo($channel); ?>" />
        <!-- Google Verification String -->
        <meta name="google-site-verification" content="c4vq-KbOsBAsVpuURAShPALVdWD1kLtTQQOVlFwLDCQ" />
        <meta name="MSSmartTagsPreventParsing" content="true">
        <meta name="MSThemeCompatible" content="no" />

        <meta name="imagetoolbar" content="false" />
        <meta name="Author" content="Jens-Andre Koch" />
        <meta name="Copyright" content="2005 - 2011 Jens-Andre Koch." />
        <meta name="Publisher" content="Koch Softwaresystemtechnik" />
        <meta name="Rating" content="general">
        <meta name="page-type" content="Homepage, Website" />
        <meta name="robots" content="index, follow, all, noodp" />

        <meta name="language" content="german, de, deutsch" />
        <meta name="DC.Title" content="Clansuite" />
        <meta name="DC.Creator" content="Jens-Andre Koch">
        <meta name="DC.Publisher" content="Koch Softwaresystemtechnik">
        <meta name="DC.Type" content="Service">
        <meta name="DC.Format" content="text/html">
        <meta name="DC.Language" content="de">
        <meta name="geo.region" content="DE-MV" />

        <meta name="geo.placename" content="Neubrandenburg" />
        <meta name="geo.position" content="53.560348;13.249941" />
        <meta name="ICBM" content="53.560348, 13.249941" />
        <base href="http://irclogs.clansuite.com/" />

        <link rel="shortcut icon" href="http://clansuite.com/favicon.ico" />
        <link rel="home" href="/">
        <link rel="prefetch" href="http://forum.clansuite.com/" title="Clansuite Forums" />
        <link rel="prefetch" href="http://trac.clansuite.com/" title="Bugtracker" />
        <link rel="prerender" href="http://forum.clansuite.com/" title="Clansuite Forums" />
        <link rel="prerender" href="http://trac.clansuite.com/" title="Bugtracker" />
        <link rel="shortcut icon" href="http://clansuite.com/favicon.ico" />
        <link rel="alternate" type="application/rss+xml" href="http://groups.google.com/group/clansuite/feed/rss_v2_0_topics.xml" title="Clansuite News" />
        <link rel="stylesheet" type="text/css" href="http://cdn.clansuite.com/css/topnavigation.css" media="all" />
        <link rel="stylesheet" type="text/css" href="http://cdn.clansuite.com/css/kubrick.css" media="all" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica+SC&amp;subset=latin" />

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript" src="http://cdn.clansuite.com/javascript/clansuite4irclog.js"></script>
        <script type="text/javascript" src="filtering.js"></script>

        <!-- IRC Log - Formatting -->
        <style type="text/css">
            .irc-date  {font-family: Courier New, Courier, mono;}
            .irc-green {color: #009200;}
            .irc-black {color: #000000;}
            .irc-brown {color: #7b0000;}
            .irc-navy  {color: #00007b;}
            .irc-brick {color: #9c009c;}
            .irc-red   {color: #ff0000;}
            #irc-log-content { line-height: 1;}
            #content { padding: 7px; font-size: 12px; width: 560px; }
            .rightpage { width: 163px; }
            #headbar a, a:link, a:visited {
                text-decoration: none;
            }

            #langs img {
                border: 0px;
            }
            #navigation { border: 1px solid #dcdcdc;
                padding: 8px;
                border-radius: 4px;
                box-shadow: -2px -10px 30px rgba(166, 166, 166, 0.1) inset, 1px 1px 1px #FFFFFF inset; }
            #headerstyle { text-align: center; width: 90%; margin-left: 20px; margin-right: 20px; }
        </style>
    </head>

    <body>
        <div id="topborder">
            &nbsp;
        </div>
        <div id="headbar">
            <div id="headmenu">
                <ul>
                    <li><img title="Clansuite Logo" alt="Clansuite Logo 80x15" width="80" height="15" src="http://cdn.clansuite.com/images/banners/clansuite-80x15.png" /></li>
                    <li><a href="http://clansuite.com/">Home</a></li>
                    <li><a href="http://clansuite.com/#page-downloads">Downloads</a></li>
                    <li><a target="_blank" href="http://docs.clansuite.com/">Dokumentation</a></li>
                    <li><a target="_blank" href="http://forum.clansuite.com/">Forum</a></li>
                    <li><a target="_blank" href="http://trac.clansuite.com/wiki">Wiki</a></li>
                    <li><a target="_blank" href="http://trac.clansuite.com/">Bugtracker</a></li>
                </ul>
            </div>
            <div id="langs">
                <ul>
                    <!-- Change Language -->
                    <li><a href="http://clansuite.com/index.en.php"><img src="http://cdn.clansuite.com/images/languages/en.gif" alt="English" title="Sprache English" /></a>&nbsp;</li>
                    <li><a href="http://clansuite.com/index.de.php"><img src="http://cdn.clansuite.com/images/languages/de.gif" alt="Deutsch" title="Sprache Deutsch" /></a>Deutsch</li>
                </ul>
            </div>
            <!-- Fork me on Github Ribbon -->
            <a href="https://github.com/jakoch/Clansuite/">
                <img style="position: absolute; top: 0; left: 0; border: 0;" src="http://cdn.clansuite.com/images/fork-me-on-github.png" height="149" width="149" alt="Fork Clansuite on GitHub" />
            </a>
        </div> <!-- Headbar End -->

        <!-- Page START -->
        <div id="page">
            <div id="header">
                <div id="headerlogo"><h1>Clansuite - just an eSports CMS</h1></div>
            </div>
            <div id="main">
                <div id="sidebar">
                    <div id="jokerlogo">
                        <img title="Clansuite Joker Logo" alt="Clansuite Joker Logo" src="http://cdn.clansuite.com/images/clansuite-joker.gif" width="134" height="152" />
                    </div>
                    <div id="menu">
                        <a href="http://clansuite.com/#page-welcome" class="menu_button">Willkommen</a>
                        <a href="http://clansuite.com/#page-reasons" class="menu_button">Gründe</a>
                        <a href="http://clansuite.com/#page-features" class="menu_button">Features</a>
                        <a href="http://clansuite.com/#page-faq" class="menu_button">FAQ</a>
                        <a href="http://clansuite.com/#page-news" class="menu_button">News</a>
                        <a href="http://clansuite.com/#page-downloads" class="menu_button">Downloads</a>
                        <a href="http://clansuite.com/#page-stats" class="menu_button">Statistik</a>
                        <a href="http://clansuite.com/#page-joinus" class="menu_button">Mitmachen !</a>
                        <a href="http://clansuite.com/#page-contact" class="menu_button">Kontakt</a>
                        <a href="http://clansuite.com/#page-license" class="menu_button">Lizenz</a>
                        <a href="http://clansuite.com/#page-privacy" class="menu_button">Impressum</a>
                    </div>
                </div>

                <!-- Start Content -->
                <div id="content">

                    <!-- Start of IRCLOGBOT Page-->
                    <h2 id="headerstyle">
                        Internet Relay Chat - Logs for <?php echo $channel; ?>
                        <br/>
                        <font size="2">Collected by <?php echo $nick; ?> on <?php echo $server; ?></font>
                    </h2>