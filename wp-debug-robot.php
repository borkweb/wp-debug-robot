<?php
/*
Plugin Name: Debug Robot
Version: 0.1
Plugin URI: http://borkweb.com
Description: Send debug output via UDP packets to a nodejs jabber bot that will IM you.
Author: Matthew Batchelder
Author URI: http://borkweb.com
Contributors: borkweb, abackstrom
Tags: debug, debugging, jabber, robot, udp
Tested up to: 3.4.1
Stable tag: 3.4
License: MIT
License URI: http://opensource.org/licenses/mit-license.php
*/

require_once __DIR__ . '/lib/class-debugrobot-robotinterface.php';
require_once __DIR__ . '/lib/class-debugrobot-dummy.php';
require_once __DIR__ . '/lib/class-debugrobot-baserobot.php';
require_once __DIR__ . '/lib/class-debugrobot-jsonrobot.php';
require_once __DIR__ . '/lib/class-debugrobot.php';
require_once __DIR__ . '/lib/class-debugrobot-admin.php';
require_once __DIR__ . '/config.php';

add_action( 'debug_robot', array( 'DebugRobot', 'send' ) );

if ( is_admin() ) {
	$debug_robot_admin = new DebugRobot_Admin;
}//end if
