/* mflogbot based on LogBot <http://www.jibble.org/logbot/> */
/* $Id: LogBot.java 3 2006-01-20 17:48:29Z RobertBachmann $ */
package org.jibble.logbot;

import java.util.*;
import java.util.regex.*;
import java.io.*;
import java.text.SimpleDateFormat;
import org.jibble.pircbot.*;

public class LogBot extends PircBot {

    private static final Pattern urlPattern = Pattern.compile("(?i:\\b((http|https|ftp|irc)://[^\\s'\">)\\]]+))");
    private static final SimpleDateFormat DATE_FORMAT = new SimpleDateFormat("yyyy-MM-dd");
    private static final SimpleDateFormat LINKTIME_FORMAT = new SimpleDateFormat("'T'HHmmss");
    private static final SimpleDateFormat TIME_FORMAT = new SimpleDateFormat
     ("'<abbr title=\"'yyyy-MM-dd'T'HH:mm:ss'+00:00\">'HH:mm:ss'</abbr>'" );
    
    public static final int ACTION       = 0;
    public static final int JOIN         = 1;
    public static final int KICK         = 2;
    public static final int MESSAGE      = 3;
    public static final int MODE         = 4;
    public static final int NICK         = 5;
    public static final int NOTICE       = 6;
    public static final int PART         = 7;
    public static final int QUIT         = 8;
    public static final int TOPIC        = 9;
    public static final int TOPIC_CHANGE = 10;
    
    private String old_linktime = ""; /* this should be local to append() */

    public LogBot(String name, File outDir, String joinMessage) {
        setName(name);
        setVerbose(true);
        this.outDir = outDir;
        this.joinMessage = joinMessage;
    DATE_FORMAT.setTimeZone(TimeZone.getTimeZone("UTC")); 
    TIME_FORMAT.setTimeZone(TimeZone.getTimeZone("UTC")); 
    LINKTIME_FORMAT.setTimeZone(TimeZone.getTimeZone("UTC")); 
    }

    public void append(int type, String line, String s) {
        /*
            Since we're using a regex to find URLs
            and replace them with ``<a href="URL">URL</a>'',
            we must escape "<", ">" and "&" afterwards.
            We must not replace ``<a href="URL">URL</a>''
            with ``&lt;a href="URL"&gt;URL&lt;/a&gt;'', so
            we need to do a little trick/hack:
            - Remove all BEL (\007) charachters from the line 
            
            - Use ``\007a href="URL"\007\007URL\007/a\007\007'' instead of
              ``<a href="URL">URL</a>''
            
            - Translate: "<" -> "&lt;" 
                         ">" -> "&gt;"
                         "&" -> "&amp;"
            - Replace: "\007\007" with ">" and "\007" with "<".
            
            This is a KLUDGE but I currently don't have the time
	    to work on a reliable URL parser.
        */
        line = Colors.removeFormattingAndColors(line);
        
        line = line.replaceAll("&", "&amp;");
        line = line.replaceAll("\007",""); 

        Matcher matcher = urlPattern.matcher(line);
        line = matcher.replaceAll("\007a href=\"$1\"\007\007$1\007/a\007\007");
                        
        line = line.replaceAll("<", "&lt;");
        line = line.replaceAll(">", "&gt;");        
        
        line = line.replaceAll("\007\007", ">");        
        line = line.replaceAll("\007", "<");        
    
    try {
            Date now = new Date();
            String date = DATE_FORMAT.format(now);
            String time = TIME_FORMAT.format(now);
            String linktime = LINKTIME_FORMAT.format(now);

            File file = new File(outDir, date + ".log");
            BufferedWriter writer = new BufferedWriter(new FileWriter(file, true));

        String entry = "<li class=\"";

            switch (type) {
                case ACTION      : entry += "action"; break;
                case JOIN        : entry += "join"; break;
                case KICK        : entry += "kick"; break;
                case MESSAGE     : entry += "message"; break;
                case MODE        : entry += "mode"; break;
                case NICK        : entry += "nick-change"; break;
                case NOTICE      : entry += "notice"; break;
                case PART        : entry += "part"; break;
                case QUIT        : entry += "quit"; break;
                case TOPIC       : entry += "topic"; break;
                case TOPIC_CHANGE: entry += "topic-change"; break;
                // no default
            }

            if (linktime.equals(old_linktime))
                 entry += "\">[" + time;
            else
                 entry += "\" id=\"" + linktime + "\">[<a href=\"#" + linktime + "\">" + time + "</a>";

            old_linktime = linktime;

        if (type != MESSAGE) {
                entry += "] <span>" + line + "</span></li>";
            } else {
                s = Colors.removeFormattingAndColors(s);
                s = s.replaceAll("&", "&amp;");
                s = s.replaceAll("<", "&lt;");
                s = s.replaceAll(">", "&gt;");        

                entry += "] &lt;<cite>" + s + "</cite>&gt; <q>" + line + "</q></li>";
            }

            writer.write(entry);
            writer.newLine();
            writer.flush();
            writer.close();
        }
        catch (IOException e) {
            System.out.println("Could not write to log: " + e);
        }
    }
    
    public void onAction(String sender, String login, String hostname, String target, String action) {
        append(ACTION, "* " + sender + " " + action,"");
    }
    
    public void onJoin(String channel, String sender, String login, String hostname) {
    append(JOIN, "* " + sender + " (" + login + "@" + hostname + ") has joined " + channel,"");
    }
    
    public void onMessage(String channel, String sender, String login, String hostname, String message) {
        append(MESSAGE,message,sender);
    }
    
    public void onMode(String channel, String sourceNick, String sourceLogin, String sourceHostname, String mode) {
        append(MODE, "* " + sourceNick + " sets mode " + mode,"");
    }
    
    public void onNickChange(String oldNick, String login, String hostname, String newNick) {
        append(NICK, "* " + oldNick + " is now known as " + newNick,"");
    }
    
    public void onNotice(String sourceNick, String sourceLogin, String sourceHostname, String target, String notice) {
//        append(NOTICE, "-" + sourceNick + "- " + notice,"");
    }
    
    public void onPart(String channel, String sender, String login, String hostname) {
        append(PART, "* " + sender + " (" + login + "@" + hostname + ") has left " + channel,"");
    }
    
    public void onPing(String sourceNick, String sourceLogin, String sourceHostname, String target, String pingValue) {
    ;
    }
    
    public void onPrivateMessage(String sender, String login, String hostname, String message) {
    ;
    }
    
    public void onQuit(String sourceNick, String sourceLogin, String sourceHostname, String reason) {
        append(QUIT, "* " + sourceNick + " (" + sourceLogin + "@" + sourceHostname + ") Quit (" + reason + ")","");
    }
    
    public void onTime(String sourceNick, String sourceLogin, String sourceHostname, String target) {
    ;
    }
    
    public void onTopic(String channel, String topic, String setBy, long date, boolean changed) {
        if (changed) {
            append(TOPIC_CHANGE, "* " + setBy + " changes topic to '" + topic + "'","");
        }
        else {
            append(TOPIC, "* Topic is '" + topic + "'","");
            append(TOPIC, "* Set by " + setBy + " on " + new Date(date),"");
        }
    }
    
    public void onVersion(String sourceNick, String sourceLogin, String sourceHostname, String target) {
    ;
    }
    
    public void onKick(String channel, String kickerNick, String kickerLogin, String kickerHostname, String recipientNick, String reason) {
        append(KICK, "* " + recipientNick + " was kicked from " + channel + " by " + kickerNick,"");
        /* if (recipientNick.equalsIgnoreCase(getNick())) {
            joinChannel(channel);
        } */
    }
    
    public void onDisconnect() {
        // append(DISCONNECT, "* Disconnected.");
        while (!isConnected()) {
            try {
                reconnect();
            }
            catch (Exception e) {
                try {
                    Thread.sleep(10000);
                }
                catch (Exception anye) {
                    // Do nothing.
                }
            }
        }
    }
    
    public static void copy(File source, File target) throws IOException {
        BufferedInputStream input = new BufferedInputStream(new FileInputStream(source));
        BufferedOutputStream output = new BufferedOutputStream(new FileOutputStream(target));
        int bytesRead = 0;
        byte[] buffer = new byte[1024];
        while ((bytesRead = input.read(buffer, 0, buffer.length)) != -1) {
            output.write(buffer, 0, bytesRead);
        }
        output.flush();
        output.close();
        input.close();
    }
    
    private File outDir;
    private String joinMessage;
    
}
