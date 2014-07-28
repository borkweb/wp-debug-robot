<?php

class DebugRobot {
	static $instance = null;

	public static function robot_from_config() {

		$config = new stdClass;
		$config->host = get_option( 'debug_robot_host' );
		$config->port = get_option( 'debug_robot_port' );
		$config->server = get_option( 'debug_robot_server' );
		$config->target = get_option( 'debug_robot_target' );
		$config->hipchat_apikey = get_option( 'debug_robot_hipchat_apikey' );
		$config->hipchat_room = get_option( 'debug_robot_hipchat_room' );
		$config->hipchat_color = get_option( 'debug_robot_hipchat_color' );
		$config->hipchat_notify = get_option( 'debug_robot_hipchat_notify' );

		if ( ! $config->host ) {
			return new DebugRobot_Dummy( null, null );
		}//end if

		if ( ! $config->hipchat_color ) {
			$config->hipchat_color = 'yellow';
		}//end if

		if ( $config->hipchat_apikey && $config->hipchat_room ) {
			$robot = new DebugRobot_HipChatRobot( $config->hipchat_apikey, $config->hipchat_room, $config->hipchat_color, $config->server );
		} else {
			$robot = new DebugRobot_JsonRobot( $config->host, $config->port, $config->server );
		}//end else

		if ( $config->target ) {
			$robot->set_data( 'target', $config->target );
		}//end if

		if ( $config->hipchat_color ) {
			$robot->set_data( 'hipchat_color', $config->hipchat_color );
		}//end if

		return $robot;
	}//end robot_from_config

	public static function send( $message, $color = NULL ) {
		$robot = self::get();

		if ( $color ) {
			$robot->set_data( 'hipchat_color', $color );
		}//end if

		return $robot->write( $message );
	}//end send

	/**
	 * Set the Robot singleton to a custom object that
	 * implements DebugRobot_RobotInterface.
	 */
	public static function set( DebugRobot_RobotInterface $instance ) {
		self::$instance = $instance;
	}//end set

	/**
	 * Return the Robot singleton.
	 */
	public static function get() {
		if( null === self::$instance ) {
			self::$instance = self::robot_from_config();
		}

		return self::$instance;
	}//end get
}//end class
