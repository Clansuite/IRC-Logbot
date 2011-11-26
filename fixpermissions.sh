#!/bin/bash
# chown / chmod the irclogs webserver dir
chown -R teamspeak:clansuite /var/syscp/webs/clansuite/irclogs
chmod -R 705 /var/syscp/webs/clansuite/irclogs
chmod 777 /var/syscp/webs/clansuite/irclogs/header.inc.php
chmod 777 /var/syscp/webs/clansuite/irclogs/footer.inc.php
chmod 777 /var/syscp/webs/clansuite/irclogs/index.php
chmod 777 /var/syscp/webs/clansuite/irclogs/config.inc.php
chmod 666 /var/syscp/webs/clansuite/irclogs/*.log
# executed by cron
chown root:root /home/clansuite/irclogbot/logbot-0.1.0/screen-run.sh