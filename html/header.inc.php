<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
    include("config.inc.php");
?>

<html>

<head>

<title><?php echo("IRC Log for $channel on $server, collected by $nick"); ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="description" content="IRC Log for <?php echo($channel); ?>" />
<meta name="keywords" content="IRC Log for <?php echo($channel); ?>" />

<style type="text/css">
body {
    background: #ffffff;
    font-family: Verdana, Arial, Helvetica, sans-serif;
    font-size: 12px;
    color: #000000;
}
.irc-date  {font-family: Courier New, Courier, mono;}
.irc-green {color: #009200;}
.irc-black {color: #000000;}
.irc-brown {color: #7b0000;}
.irc-navy  {color: #00007b;}
.irc-brick {color: #9c009c;}
.irc-red   {color: #ff0000;}
}
</style>

</head>

<body>

<h1><?php echo($channel); ?> IRC Log</h1>
