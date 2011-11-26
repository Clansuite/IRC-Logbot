<?php
/* mflogbot based on LogBot <http://www.jibble.org/logbot/> */
/* $Id: index.php 4327 2010-03-28 00:57:40Z vain $ */	
    include("config.inc.php");
    
    $date = $_GET['date'];
    $next = "";
    $prev = "";

    if (isset($date) && preg_match("/^\d\d\d\d-\d\d-\d\d$/", $date))
        $single_page=true;
    else
        $single_page=false;
        
    $dir = opendir(".");
    while (false !== ($file = readdir($dir))) {
        if (strpos($file, ".log") == 10) {
            $filearray[] = substr($file, 0, 10);
        }
    }
    closedir($dir);

    rsort($filearray);
    
    if ($single_page) { 
        for ($i=0; i < count($filearray); $i++) { 
            if ($filearray[$i] == $date) {
                if ($i > 0) $next=$filearray[$i-1];
                if ($i+1 < count($filearray)) $prev=$filearray[$i+1];
                break;
            }
        }
    }
    
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<!--
 mflogbot based on LogBot <http://www.jibble.org/logbot/> 
 $Id: index.php 4327 2010-03-28 00:57:40Z vain $ 
-->
<head>
<title><?php
    if ($single_page) 
        echo 'IRC Log for '.$channel.' on '.$date;
    else
        echo 'IRC Log for '.$channel;
?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="contents" href="./" />
<?php 
    if ($next!="") {
        echo '<link rel="next" href="'.$next.'" />';
    }
    if ($prev!="") {
        echo '<link rel="previous" href="'.$prev.'" />';
    }
?>
<link rel="stylesheet" href="style.css" />
<script src="script.js" type="text/javascript"> </script>
</head>
<body>
<h1><?php 
    if ($single_page) {
        echo 'IRC Log for '.$channel.' on '.$date;
    } else {
        echo 'IRC Log for '.$channel;
    }
?></h1>
<?php if ($single_page) { ?>
<ul id="navigation">
<li><a href="./">Index</a></li><?php 
    if ($next!="") {
         echo '<li>Next: <a rel="next" href="'.$next.'">'.$next.'</a></li>';
    }
    if ($prev!="") {
         echo '<li>Previous: <a rel="previous" href="'.$prev.'">'.$prev.'</a></li>';
    }
?></ul>
<p>Timestamps are in UTC.</p>
<ol id="log"><?php
        readfile('./' . $date . '.log');
?></ol>
<?php
    }
    else {
?>
<ol id="logs"><?php
        foreach ($filearray as $file) {
            $file = substr($file, 0, 10);
            echo '<li><a href="'.$file.'">'.$file.'</a></li>'."\n";
        }
?></ol><?php } ?>
<p>
These logs were automatically created by <b><?php echo($nick); ?></b> on
<a href="irc://<?php echo($server . "/" . substr($channel, 1)); ?>"><?php echo($server); ?></a>
using a <a href="./Source">modified version</a> of the <a href="http://www.jibble.org/logbot/">Java IRC LogBot</a>.
</p>
<p>See <a href="http://microformats.org/wiki/mflogbot">http://microformats.org/wiki/mflogbot</a> for more information.</p>
</body>
</html>
