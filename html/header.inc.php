<?php
# Security Handler
if (!defined('IN_CSLOGBOT')){ die('Clansuite Logbot not loaded. Direct Access forbidden.'); }
include dirname(__FILE__) . '/config.inc.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title><?php echo("IRC Log for $channel on $server, collected by $nick"); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="IRC Log for <?php echo($channel); ?>" />
<meta name="keywords" content="IRC Log for <?php echo($channel); ?>" />
<link rel="shortcut icon" href="http://www.clansuite.com/favicon.ico" />
<link rel="stylesheet" type="text/css" media="screen" href="http://www.clansuite.com/website/css/topnavigation.css" />
<link rel="stylesheet" type="text/css" media="screen" href="http://www.clansuite.com/website/css/standard.css" />
<link rel="stylesheet" type="text/css" media="screen" href="http://www.clansuite.com/website/css/kubrick.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://www.clansuite.com/website/javascript/clansuite4irclog.js"></script>
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
    #maincontent { padding: 30px;}
</style>

<style type="text/css">
#headbar a, a:link, a:visited {
 text-decoration: none;
}

#langs img {
 border: 0px;
}
</style>
</head>

<body>
<div id="topborder">
    &nbsp;
</div>
<div id="headbar">
        <div id="headmenu">
            <ul>
                <li><img title="Clansuite Logo" alt="Clansuite Logo 80x15" width="80" height="15" src="website/images/banners/clansuite-80x15.png" /></li>
                <li><a href="http://www.clansuite.com/">Home</a></li>
                <li><a href="http://www.clansuite.com/index.php#page-downloads">Downloads</a></li>
                <li><a target="_blank" href="http://www.clansuite.com/documentation/">Dokumentation</a></li>
                <li><a target="_blank" href="http://forum.clansuite.com/">Forum</a></li>
                <li><a target="_blank" href="http://trac.clansuite.com/wiki">Wiki</a></li>
                <li><a target="_blank" href="http://trac.clansuite.com/">Bugtracker</a></li>
            </ul>
        </div>
        <div id="langs">
            <ul>
                <!-- Change Language -->
                <li><a href="http://www.clansuite.com/index.en.php"><img src="website/images/languages/en.gif" alt="English" title="Sprache English" /></a>&nbsp;</li>
                <li><a href="http://www.clansuite.com/index.de.php"><img src="website/images/languages/de.gif" alt="Deutsch" title="Sprache Deutsch" /></a>Deutsch</li>
            </ul>
        </div>
</div> <!-- Headbar End -->

<!-- Page START -->
<div id="page">
    <div id="header">
        <div id="headerlogo">
            Clansuite - just an eSports CMS
        </div>
    </div>
    <hr />
    <div id="main">
    <div id="sidebar">
        <div id="jokerlogo">
            <img title="Clansuite Joker Logo" alt="Clansuite Joker Logo" src="website/images/clansuite-joker.gif"/>
        </div>
        <div id="menu">
        <a href="#page-welcome" class="menu_button">Willkommen</a>
        <a href="#page-reasons" class="menu_button">Gründe</a>
        <a href="#page-features" class="menu_button">Features</a>
        <a href="#page-faq" class="menu_button">FAQ</a>
        <a href="#page-news" class="menu_button">News</a>
        <a href="#page-downloads" class="menu_button">Downloads</a>
        <a href="#page-stats" class="menu_button">Statistik</a>
        <a href="#page-joinus" class="menu_button">Mitmachen !</a>
        <a href="#page-contact" class="menu_button">Kontakt</a>
        <!-- <a href="#page-jobs" class="menu_button">Jobs</a> -->
        <a href="#page-license" class="menu_button">Lizenz</a>
        <a href="#page-privacy" class="menu_button">Impressum</a>
        </div>
    </div>

    <!-- Start Content -->
    <div id="content">

    <!-- Start of IRCLOGBOT Page-->
    <h2 class="headerstyle" style="text-align: center;">
        Internet Relay Chat - Logs for <?php echo $channel; ?>
        <br/>
        <font size="2">Collected by <?php echo $nick; ?> on <?php echo $server; ?></font>
    </h2>