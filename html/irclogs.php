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
    * @author     Jens-Andre Koch <vain@clansuite.com>
    * @copyright  Jens-Andre Koch (2005 - onwards)
    * @link       http://www.clansuite.com
    *
    * @version    SVN: $Id: extract-weblinks.php 4327 2010-03-28 00:57:40Z vain $
    */

# define Clansuite Logbot Security Constant
if(!defined('IN_CSLOGBOT'))
{
    define('IN_CSLOGBOT', true);
}

setlocale(LC_ALL,'de_DE.UTF-8');
setlocale(LC_TIME, 'de_DE');

/**
 * ONE DAYS CONTENT => View Single Logfile by appending date to URL, like: "?date=2009-02-09"
 */
if(isset($_GET['date']))
{
    $date = $_GET['date'];
}

if (isset($date) && preg_match('/^\d\d\d\d-\d\d-\d\d$/', $date))
{
    $year = substr($date, 0, 4);
    $month = substr($date, 5, 2);
    $day = substr($date, 8, 2);

    if($date < date('Y-m-d'))
    {
        $next = date('Y-m-d', strtotime('+1 day', strtotime($date)));
    }
    $prev = date('Y-m-d', strtotime('-1 day', strtotime($date)));

?>
    <div id="navigation">
    <?php
        /**
         * Include the cached Calendar for this month
         */
        $calendar_cache_file = '/cache/'.$month.'-'.$year.'.calendar.php';
        if(is_file( __DIR__  . $calendar_cache_file) === true)
        {
            echo '<table width="100%"><tr><td width="40%">&nbsp;</td><td>';
            require_once  __DIR__ . $calendar_cache_file;
            echo '</td><td width="40%">&nbsp;</td></tr></table>';
        }
        unset($calendar_cache_file);
    ?>
    <ul style="list-style-type: none; padding: 0px;">
    <li style="text-align: center;"><a href="./">Index</a></li>
    <?php
        if (isset($next))
        {
             echo '<li style="float:right;">(next) <a rel="next" href="index.php?date='.$next.'">'.$next.' &raquo;</a></li>';
        }
        if (isset($prev))
        {
             echo '<li style="float:left;"><a rel="previous" href="index.php?date='.$prev.'">&laquo; '.$prev.'</a> (previous)</li>';
        }
    ?>
    </ul>
    </div>

    <h2>IRC Log for <?php echo strftime('%A, %d. %B %Y', mktime(0, 0, 0, $month, $day, $year)); ?></h2>

    <ol id="log" style="padding-left: 0px;">
    <?php
            # conditional include of the link grabber
            include dirname(__FILE__) . '/extract-weblinks.php';

            # init LinkGrabber
            $linkGrabber = new Clansuite_LinkGrabber;

            /**
             * Load log file and display
             */
            $filename = $date.'.log';
            if(is_file($filename) and is_readable($filename))
            {
                $fp = fopen($filename, 'rb');
                while(($current_line = fgets($fp, 1024)) !== false)
                {
                    $lines[] = $current_line;
                    $linkGrabber->grabLinks($current_line);
                }
                fclose($fp);

                # print file linewise, add anchors, like "?date=2009-02-09#27" will jump to line 27
                $number_of_lines = count($lines);
                for($i = 1; $i < $number_of_lines; $i++)
                {
                    echo '<li style="list-style: none" class="irc-linenum"><a name="' . $i . '">' . $i . '</a>: ' . $lines[$i];
                    echo '</li>';
                }
            }
            else
            {
                echo 'The IRC log file was not found or is not readable.';
                exit;
            }
    ?>
    </ol>
    <h2>Links of <?php echo strftime('%A, %d. %B %Y', mktime(0, 0, 0, $month, $day, $year)); ?></h2>
    <?php
        echo $linkGrabber->displayListOfLinks();
     ?>
<?php
}
/**
 * ALL DAYS OVERVIEW => Display Overview of Logfiles available
 */
else
{
    # Alle Logfiles einlesen
    $dir = opendir(".");
    while(false !== ($file = readdir($dir)))
    {
        if(strpos($file, ".log") == 10)
        {
            $filearray[] = $file;
        }
    }
    closedir($dir);

    arsort($filearray, SORT_STRING);

    # Array aufbereiten
    foreach($filearray as $file)
    {
        $file = substr($file, 0, 10);

        $year = substr($file, 0, 4);
        $month = substr($file, 5, 2);
        $day = substr($file, 8, 2);

        $years_array["$year"]["$month"]["$day"] = $file;
    }

    /** OUTPUT **/
    ?>
    <ul>Year(s):
    <?php
    # Display Links for all Years
    foreach ($years_array as $year => $months)
    {
        echo '<a href="#'.$year.'">'.$year.' </a>';
    }

    foreach ($years_array as $year => $months)
    {
        # Year Name + Anchor
        echo '<h3><a name="'.$year.'">'.$year.'</a></h3>';

        echo 'Month(s): <br />';

        # Display Links for all Months
        foreach($months as $month => $days)
        {
            $monthname = strftime("%B", mktime(0, 0, 0, $month, '01', $year));
            echo '<a href="#'.$year.'-'.$month.'">'.$monthname.' </a>';
            if($month == '07') { echo '<br />'; }
        }

        echo '<br />';

        include_once __DIR__ . '/calendar.php';
               
        foreach ($months as $month => $days)
        {
            /**
             * Display  list of days
             */
            $monthname = strftime('%B', mktime(0, 0, 0, $month, '01', $year));
            echo '<h3><a name="'.$year.'-'.$month.'">'.$monthname.'</a></h3>';
            echo '<blockquote>';

            arsort($days);

            $days_data = array();
            foreach($days as $day => $filename)
            {
                $link = $_SERVER['PHP_SELF'] . '?date=' . $filename;
                $days_data[$day] = array($link, 'linked-day');
                
            ?>
                <li>
                    <a href="<?php echo $link; ?>">
                        <?php echo strftime('%A, %d. %B %Y', mktime(0, 0, 0, $month, $day, $year)); ?>
                    </a>
                </li>
            <?php
            }
            echo '</blockquote>';

            /**
             * Display calendar
             */

            ob_start();
            # the content of the calendar
            echo generate_calendar($year, $month, $days_data, 3, null, 1);
            $calendar_content = ob_get_contents();
            ob_end_clean();

            file_put_contents(__DIR__ . '/cache/'.$month.'-'.$year.'.calendar.php', $calendar_content);
            
            echo $calendar_content;

            unset($days_data);
        }
    }

    ?></ul>

<?php
}
?>