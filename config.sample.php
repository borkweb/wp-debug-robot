<?php

global $debug_robot_config;

$debug_robot_config         = new stdClass;

# host name to send UDP packets to (IP address that your jabber bot is running)
$debug_robot_config->host   = '127.0.0.1';

# port number on the above host that you wish to target UDP packets to
$debug_robot_config->port   = 8888;

# default email address the jabber bot should direct received messages to (this is NOT the email address of the jabberbot itself)
$debug_robot_config->target = 'your@emailaddress.com';

# if you wish to identify your message as coming from something other than the hostname of your server, you can set that here:
# $debug_robot_config->server = 'Test Server';
