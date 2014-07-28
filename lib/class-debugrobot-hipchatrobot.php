<?php

class DebugRobot_HipChatRobot extends DebugRobot_BaseRobot {
	public $data = array();

	/**
	 * Server the robot is being run from
	 */
	public $server;

	/**
	 * Room the robot will send messages to
	 */
	public $room;

	/**
	 * color the robot will send messages as
	 */
	public $color = 'yellow';

	/**
	 * Target user this message is being sent to
	 */
	public $target;

	public function __construct( $apikey, $room, $color = 'yellow', $server = NULL ) {
		$this->server = $server ?: gethostname();
		$this->server = substr( $this->server, 0, 15 );
		$this->apikey = $apikey;
		$this->room = $room;
		$this->color = $color;

		parent::__construct( NULL, NULL );
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

		if ( empty( $data['hipchat_color'] ) || ! in_array( $data['hipchat_color'], debugrobot_admin()->colors ) ) {
			$data['hipchat_color'] = $this->color;
		}//end if


		$this->hipchat()->message_room(
			$this->room,
			$this->server,
			'/code ' . $contents,
			empty( $data['hipchat_notify'] ) ? FALSE : TRUE,
			$data['hipchat_color'],
			'text'
		);
	}//end _write

	private function hipchat() {
		static $hipchat;

		if ( ! $hipchat ) {
			require_once __DIR__ . '/external/hipchat-php/src/HipChat/HipChat.php';

			$hipchat = new HipChat\HipChat( $this->apikey );
		}//end if

		return $hipchat;
	}//end hipchat
}//end class
