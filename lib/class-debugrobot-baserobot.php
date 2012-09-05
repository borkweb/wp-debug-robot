<?php

class DebugRobot_BaseRobot implements DebugRobot_RobotInterface {
	/**
	 * Hostname of the robot listener.
	 */
	public $host;

	/**
	 * Port the robot is listening on.
	 */
	public $port;

	/**
	 * The socket connection.
	 */
	public $socket = null;

	public function __construct( $host, $port = 8888 ) {
		$this->host = $host;
		$this->port = $port;
	}//end __construct

	public function var_dump() {
		ob_start();
		call_user_func_array( 'var_dump', func_get_args() );
		$this->_write( ob_get_clean() );
	}//end var_dump

	/**
	 * Write a simple string using the robot.
	 */
	public function write( $message ) {
		$this->_write( $message );
	}//end write

	public function _write( $contents ) {
		if( null === $this->socket ) {
			$this->socket = fsockopen("udp://{$this->host}", $this->port, $errno, $errstr);
			if( ! $this->socket ) {
				return;
			}
		}

		fwrite( $this->socket, $contents );
	}//end _write
}//end class Robot
