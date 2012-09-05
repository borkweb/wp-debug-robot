<?php
/*
Plugin Name: Debug Robot
Version: 0.1
Plugin URI: http://borkweb.com
Description: Send debug output via UDP packets to a nodejs jabber bot that will IM you.
Author: Matthew Batchelder
Author URI: http://borkweb.com
*/

require_once __DIR__ . '/lib/class-debugrobot-robotinterface.php';
require_once __DIR__ . '/lib/class-debugrobot-dummy.php';
require_once __DIR__ . '/lib/class-debugrobot-baserobot.php';
require_once __DIR__ . '/lib/class-debugrobot-jsonrobot.php';
require_once __DIR__ . '/lib/class-debugrobot.php';
require_once __DIR__ . '/config.php';

add_action( 'debug_robot', array( 'DebugRobot', 'send' ) );
