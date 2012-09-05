<?php

class DebugRobot {
	static $instance = null;

	public static function robot_from_config() {
		global $debug_robot_config;

		if ( ! $debug_robot_config->host ) {
			return new DebugRobot_Dummy( null, null );
		}//end if

		$robot = new DebugRobot_JsonRobot( $debug_robot_config->host, $debug_robot_config->port );

		if ( $debug_robot_config->target ) {
			$robot->set_data( 'target', $debug_robot_config->target );
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
