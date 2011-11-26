#!/bin/bash
# $Id: run.sh 5154 2011-02-20 23:54:32Z vain $
nohup LANG='de_DE.UTF-8' java -Djava.awt.headless=true -classpath .:./lib/pircbot.jar org.jibble.logbot.LogBotMain >> logbot.log &