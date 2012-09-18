<?php

class DebugRobot_JsonRobot extends DebugRobot_BaseRobot {
	public $data = array();

	/**
	 * Server the robot is being run from
	 */
	public $server;

	/**
	 * Target user this message is being sent to
	 */
	public $target;

	public function __construct( $host, $port = 8888, $server = null ) {
		$this->server = $server ?: gethostname();

		parent::__construct( $host, $port );
	}//end constructor

	public function set_data( $key, $value ) {
		if( $value === null ) {
			unset( $this->data[ $key ] );
		} else {
			$this->data[ $key ] = $value;
		}//end else
	}//end set_data

	public function write( $message, $data = array() ) {
		$this->_write( $message, $data );
	}//end write

	public function _write( $contents, $data = array() ) {
		$data = array_merge( $this->data, (array) $data );

		$message = array(
			'server' => $this->server,
			'message' => $contents,
			'data' => $data,
		);

		parent::_write( json_encode( $message ) );
	}//end _write
}//end class
