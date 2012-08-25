#!/bin/bash

# chown / chmod the irclogs webserver dir

# suexec needs teamspeak:clansuite
chown -R teamspeak:clansuite /var/www/webs/clansuite/irclogs
# user teamspeak needs to write to /irclogs (user clansuite, group clansuite)
chmod -R 777 /var/www/webs/clansuite/irclogs
chmod 777 /var/www/webs/clansuite/irclogs/header.inc.php
chmod 777 /var/www/webs/clansuite/irclogs/footer.inc.php
chmod 777 /var/www/webs/clansuite/irclogs/index.php
chmod 777 /var/www/webs/clansuite/irclogs/config.inc.php
# the logfiles
chmod 666 /var/www/webs/clansuite/irclogs/*.log
# the restart script is executed by cron, so it needs root
chown root:root /home/clansuite/IRC-Logbot/screen-run.sh
# the bot itself is executed by user teamspeak
chown teamspeak:user /home/clansuite/IRC-Logbot/lib/pircbot.jar
chmod +x /home/clansuite/IRC-Logbot/lib/pircbot.jar
