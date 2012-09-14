<?php

class DebugRobot {
	static $instance = null;

	public static function robot_from_config() {

		$config = new stdClass;
		$config->host = get_option( 'debug_robot_host' );
		$config->port = get_option( 'debug_robot_port' );
		$config->target = get_option( 'debug_robot_target' );

		if ( ! $config->host ) {
			return new DebugRobot_Dummy( null, null );
		}//end if

		$robot = new DebugRobot_JsonRobot( $config->host, $config->port );

		if ( $config->target ) {
			$robot->set_data( 'target', $config->target );
		}//end if

		return $robot;
	}//end robot_from_config

	public static function send( $message, $target = null ) {
		$robot = self::get();

		if ( $target ) {
			$robot->set_data( 'target', $target );
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
