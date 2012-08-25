#!/bin/bash

#ps ax | grep LogBotMain | grep -v grep | awk '{print $1}' | xargs kill -9
LANG='de_DE.UTF-8'
nice -n 15 nohup java -classpath .:./lib/pircbot.jar org.jibble.logbot.LogBotMain > logbot.log &