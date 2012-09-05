<?php

interface DebugRobot_RobotInterface {
	public function __construct( $host, $port );
	public function var_dump();
	public function write( $message );
	public function _write( $contents );
}//end class
