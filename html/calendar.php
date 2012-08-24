<?php
// http://en.wikipedia.org/wiki/ASCII
define('CR', chr(13));
define('TAB', chr(9));

/**
 * PHP Calendar 2.4 - 20.01.2012
 *
 * This is a fork of PHP Calendar (version 2.3).
 * @author      Keith Devens
 * @link        http://keithdevens.com/software/php_calendar
 * @examples    http://keithdevens.com/weblog
 * @license     http://keithdevens.com/software/license
 *
 * @license    GNU/GPL v2 or (at your option) any later version.
 * @author     Jens-Andr� Koch <jakoch@web.de>
 * @copyright  Copyleft: All rights reserved. Jens-Andr� Koch (2012 - onwards)
 */
function generate_calendar($year, $month, $days = array(), $day_name_length = 3, $month_href = NULL, $first_day = 0, $pn = array())
{
    /**
     * mktime will automatically correct, if invalid dates are entered
     * for instance, mktime(0,0,0,12,32,1997) will be the date for Jan 1, 1998
     */
    $first_of_month = gmmktime(0, 0, 0, $month, 1, $year);

    $day_names = array();

    # generate all the day names according to the current locale
    for($n = 0, $t = (3 + $first_day) * 86400; $n < 7; $n++, $t+=86400)
    {
        # %A means full textual day name
        $day_names[$n] = ucfirst(gmstrftime('%A', $t));
    }

    list($month, $year, $month_name, $weekday) = explode(',', gmstrftime('%m,%Y,%B,%w', $first_of_month));

    # adjust for $first_day
    $weekday = ($weekday + 7 - $first_day) % 7;

    #note that some locales don't capitalize month and day names
    $title = htmlentities(ucfirst($month_name)) . '&nbsp;' . $year;

    /**
     * previous and next links, if applicable
     */
    list($p, $pl) = each($pn);

    list($n, $nl) = each($pn);

    if($p)
    {
        $p = '<span class="calendar-prev">' . ($pl ? '<a href="' . htmlspecialchars($pl) . '">' . $p . '</a>' : $p) . '</span>&nbsp;';
    }

    if($n)
    {
        $n = '&nbsp;<span class="calendar-next">' . ($nl ? '<a href="' . htmlspecialchars($nl) . '">' . $n . '</a>' : $n) . '</span>';
    }

    /**
     * Begin calendar. Uses a real <caption>. See http://diveintomark.org/archives/2002/07/03
     */

    $calendar = '<table class="calendar">'.CR;
    $calendar .= '<caption class="calendar-month">'.CR;
    $calendar .= $p.CR;
    $calendar .= $month_href ? '<a href="' . htmlspecialchars($month_href) . '">' . $title . '</a>' : $title;
    $calendar .= $n.CR;
    $calendar .= '</caption>'.CR.'<tr>'.CR;

    if($day_name_length)
    { #if the day names should be shown ($day_name_length > 0)
        #if day_name_length is >3, the full name of the day will be printed
        foreach($day_names as $d)
        {
            $calendar .= '<th abbr="' . htmlentities($d) . '">' . htmlentities($day_name_length < 4 ? substr($d, 0, $day_name_length) : $d) . '</th>'.CR;
        }
        $calendar .= '</tr>'.CR.'<tr>'.CR;
    }

    # initial 'empty' days
    if($weekday > 0)
    {
        $calendar .= '<td colspan="' . $weekday . '">&nbsp;</td>'.CR;
    }

    /**
     *  convert indexded array into a named assoc array
     */
    if(isset($days) and is_array($days))
    {
        $days_data = array();
        foreach($days as $day => $values)
        {
            $days_data[(int)$day] = array (
                'link'     => isset($values['0']) ? htmlspecialchars($values['0']) : null,
                'text'     => isset($values['2']) ? htmlspecialchars($values['1']) : null
                #'icon'
            );
        }
        unset($days);
    }

    for($day = 1, $days_in_month = gmdate('t', $first_of_month); $day <= $days_in_month; $day++, $weekday++)
    {
        # start a new week
        if($weekday == 7)
        {
            $weekday = 0;
            $calendar .= '</tr>'.CR.'<tr>';
        }

        /**
         * Handle data array for all days
         */
        if(isset($days_data[$day]))
        {
            $calendar .= '<td>';
            $calendar .= isset($days_data[$day]['link']) ? '<a href="' . $days_data[$day]['link'] . '">' . $day . '</a>' : 'no-link';
            $calendar .= '</td>'.CR;
        }
        else
        {
            $calendar .= "<td>$day</td>".CR;
        }
    }

    # remaining "empty" days
    if($weekday != 7)
    {
        $calendar .= '<td colspan="' . (7 - $weekday) . '">&nbsp;</td>'.CR;
    }

    $calendar .= '</tr>'.CR.'</table>';

    if(extension_loaded('tidy') === true)
    {
        $calendar = cleaning($calendar);
    }

    return $calendar;
}

function cleaning($string_to_clean = null, $tidy_config = null)
{
    $config = array(
        'show-body-only' => false,
        'clean' => true,
        'char-encoding' => 'utf8',
        'add-xml-decl' => true,
        'add-xml-space' => true,
        'output-html' => false,
        'output-xml' => false,
        'output-xhtml' => true,
        'numeric-entities' => false,
        'ascii-chars' => false,
        'doctype' => 'strict',
        'bare' => true,
        'fix-uri' => true,
        'indent' => true,
        'indent-spaces' => 4,
        'tab-size' => 4,
        'wrap-attributes' => true,
        'wrap' => 0,
        'indent-attributes' => true,
        'join-classes' => false,
        'join-styles' => false,
        'enclose-block-text' => true,
        'fix-bad-comments' => true,
        'fix-backslash' => true,
        'replace-color' => false,
        'wrap-asp' => false,
        'wrap-jste' => false,
        'wrap-php' => false,
        'write-back' => true,
        'drop-proprietary-attributes' => false,
        'hide-comments' => false,
        'hide-endtags' => false,
        'literal-attributes' => false,
        'drop-empty-paras' => true,
        'enclose-text' => true,
        'quote-ampersand' => true,
        'quote-marks' => false,
        'quote-nbsp' => true,
        'vertical-space' => true,
        'wrap-script-literals' => false,
        'tidy-mark' => true,
        'merge-divs' => false,
        'repeated-attributes' => 'keep-last',
        'break-before-br' => true,
    );

    if( $tidy_config == null )
    {
        $tidy_config = $config;
    }

    $tidy = new tidy();
    $out = $tidy->repairString($string_to_clean, $tidy_config, 'utf8');
    unset($tidy, $tidy_config);
    return($out);
}
?>