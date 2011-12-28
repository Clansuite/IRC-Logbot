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
?>
<p>
    These logs were automatically created by <b><?php echo($nick); ?></b> on
    <a href="irc://<?php echo($server . "/" . substr($channel, 1)); ?>"><?php echo($server); ?></a>
    using the <a href="http://clansuite.com/">Clansuite IRC LogBot</a>. Find the project at <a href="https://github.com/jakoch/IRC-Logbot/">Github</a>.
</p>
</div><!-- Close maincontent of irclogbot -->

<!-- Start rightpage1 -->
<div class="rightsidebar rightpage rightpage1">
    <div class="box">
        <ul style="text-align: center;">
            <li><h2>Aktuelle Version</h2></li>
            <li><strong>0.2 alpha</strong><br /><br />
                <strong><strike><a href="http://clansuite.com/index.de.php#page-downloads">Download</a></strike></strong>
            </li>
        </ul>
    </div>
    <!-- Ende Box1 -->
    <!-- Box 2 -->
    <div class="box">
        <ul>
            <li><h2>Links für Nutzer</h2></li>
            <li><strong><a href="http://docs.clansuite.com/">Dokumentation</a></strong></li>
            <li><strong><a target="_blank" href="http://forum.clansuite.com/">Forum</a></strong></li>
            <!-- <li><strong><a target="_blank" href="http://trac.clansuite.com/wiki/">Wiki</a></strong></li> -->
            <li><strong><a href="http://webchat.quakenet.org/?channels=clansuite">IRC Webchat</a></strong></li>

            <!-- Live Support (Link and Tracking) -->
            <li><h2>Möchten Sie  Hilfe?</h2></li>
            <li>
                <!-- Start Live Support Javascript -->
                <div style="text-align:center;width:120px;">
                    <a href="javascript:void(window.open('http://support.clansuite.com/livezilla.php?intgroup=Q2xhbnN1aXRlLVN1cHBvcnQ=&amp;code=V2Vic2VpdGUgY2xhbnN1aXRlLmNvbQ__&amp;reset=true','','width=600,height=600,left=0,top=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes'))">
                        <img src="http://support.clansuite.com/image.php?id=05" width="120" height="30" alt="LiveZilla Live Help" />
                    </a>
                    <noscript>
                        <div><a href="http://support.clansuite.com/livezilla.php?intgroup=Q2xhbnN1aXRlLVN1cHBvcnQ=&amp;code=V2Vic2VpdGUgY2xhbnN1aXRlLmNvbQ__&amp;reset=true" target="_blank">Start Live Help Chat</a></div>
                    </noscript>
                </div>
                <!-- End Live Support Javascript -->

                <!-- Start Live Support Tracking Javascript -->
                <div id="livezilla_tracking" style="display:none"></div>
                <script type="text/javascript">/* <![CDATA[ */
                    var script = document.createElement("script");script.type="text/javascript";var src = "http://support.clansuite.com/server.php?request=track&output=jcrpt&nse="+Math.random();setTimeout("script.src=src;document.getElementById('livezilla_tracking').appendChild(script)",1);
                    /* ]]> */</script>
                <!-- End Live Support Tracking Javascript -->
            </li>
        </ul>
    </div>
    <!-- Ende Box2 -->
    <!-- Box 3 -->
    <div class="box">
        <ul>
            <li><h2>Fehler gefunden?</h2></li>
            <li><strong><a target="_blank" href="http://trac.clansuite.com/">Bugtracker</a></strong></li>
            <li><b>Core</b></li>
            <li><strong><a target="_blank" href="http://clansuite.com/trac/newticket?type=defect | bug&amp;component=Core">Report Bug </a></strong></li>
            <li><strong><a target="_blank" href="http://clansuite.com/trac/newticket?type=enhancement | feature requestamp;component=Core">Request Feature</a></strong></li>
            <li><b>Modules</b></li>
            <li><strong><a target="_blank" href="http://clansuite.com/trac/newticket?type=defect | bugamp;component=Module">Report Bug </a></strong></li>
            <li><strong><a target="_blank" href="http://clansuite.com/trac/newticket?type=enhancement | feature requestamp;component=Module">Request Feature</a></strong></li>
        </ul>
    </div>
    <!-- Ende Box3 -->
</div>
<!-- rightpage1 ENDE -->

<!-- rightpage2 START -->
<div class="rightsidebar rightpage rightpage2">
    <!-- Box 2 -->
    <div class="box">
        <ul>
            <li><h2>Links für Entwickler</h2></li>
            <li><strong><a target="_blank" href="irc://irc.quakenet.org:6667/clansuite">IRC #clansuite@Qnet </a></strong></li>
            <li><strong><a target="_blank" href="http://irclogs.clansuite.com/">IRC Logs</a></strong></li>
            <li><strong><a href="ts3server://clansuite.com:9987/">Teamspeak</a></strong></li>
            <li><strong><a href="http://clansuite.com/toolbar/">Toolbar</a></strong></li>
            <?php /**
              <h2>Ohloh</h2>
              <li><script type="text/javascript" src="http://www.ohloh.net/projects/5526/widgets/project_thin_badge"></script></li>

              <h2>SVN Speedometer</h2>
              <li><img src="odometer.php?p=60" alt="Tacho"></li>
             */ ?>
        </ul>
    </div>
    <!-- Ende Box2 -->
</div>
<!-- rightpage2 ENDE -->
</div> <!-- content -->

<!-- Fusszeile -->
<div id="footer">
    <br />
    <p style="filter:alpha(opacity=65); opacity: .65;">
        <?php

        function LastModified()
        {
            //Last filechanges
            $filemod = strftime('%A, %d-%m-%Y %R', filemtime($_SERVER['SCRIPT_FILENAME']));
            return $filemod;
        }
        ?>
        <br />
        Clansuite - just an eSports CMS! -  is a Free Content Management System especially for Clans and eSports Teams.
        <br/>
        Based on PHP5+, Doctrine, Smarty, Ajax. - Easy, comfortable, fast, flexible.
        <br />
        &copy; 2005-<?php echo date("Y"); ?> by <a href="http://www.jens-andre-koch.de" target="_blank" style="text-decoration=none">Jens-Andr&#x00E9; Koch</a>.
        <br />
        <br />
        <span id="footer-left" style="float:left; text-align:left; margin-top: -30px;">
            <a href="http://www.opensource.org/" target="_blank"><img style="opacity: 0.90;" src="http://cdn.clansuite.com/images/banners/opensource-75x65-t.png" alt="OpenSource Logo" title="OpenSource Logo" /></a>
        </span>
        <strong>Letzte &Auml;nderung der Seite:</strong> <?php echo LastModified(); ?>
        <span id="footer-right" style="float:right; text-align:right;">
            <a href="http://clansuite.com/banner/" target="_blank">
                <!--
                <img src="http://cdn.clansuite.com/images/banners/powered_by_clansuite.png" alt="Clansuite 80x32 Logo" title="Clansuite Logo" />
                -->
                <img src="http://cdn.clansuite.com/banners/clansuite-crown-banner-88x31.png" alt="Clansuite 80x31 Crown Logo" title="Clansuite Logo" />
            </a>
        </span>
    </p>
</div><!-- Fusszeile ENDE -->
</div><!-- PAGE ENDE -->

<!-- Google Analytics -->
<script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
    <!-- check for _gat, it may be blocked by adfilters -->
    if (typeof(_gat) == "object")
    {
    var pageTracker = _gat._getTracker("UA-3479872-1");
    pageTracker._initData();
    pageTracker._trackPageview();
    }
</script>
</body>
</html>