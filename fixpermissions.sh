#!/bin/bash
# chown / chmod the irclogs webserver dir
# suexec needs clansuite:clansuite
chown -R teamspeak:clansuite /var/www/webs/clansuite/irclogs
# user teamspeak needs to write to /irclogs (user clansuite, group clansuite)
chmod -R 777 /var/www/webs/clansuite/irclogs
chmod 777 /var/www/webs/clansuite/irclogs/header.inc.php
chmod 777 /var/www/webs/clansuite/irclogs/footer.inc.php
chmod 777 /var/www/webs/clansuite/irclogs/index.php
chmod 777 /var/www/webs/clansuite/irclogs/config.inc.php
chmod 666 /var/www/webs/clansuite/irclogs/*.log
# executed by cron
chown root:root /home/clansuite/irclogbot/logbot-0.1.0/screen-run.sh
# executed by user teamspeak
chown teamspeak:user /home/clansuite/IRC-Logbot/lib/pircbot.jar
chmod +x /home/clansuite/IRC-Logbot/lib/pircbot.jar
