#!/bin/bash
CPATH=/home/clansuite/irclogbot/logbot-0.1.0
ps ax | grep -v grep | grep -v -i SCREEN | grep LogBotMain | awk '{print $1}' | xargs kill -9
sleep 7
su -l teamspeak -c "cd $CPATH && screen -dmS IRCLogBot java -classpath .:$CPATH:$CPATH/lib/pircbot.jar org.jibble.logbot.LogBotMain"