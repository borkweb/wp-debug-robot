<?php

class DebugRobot_Admin {
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
	}//end constructor

	public function admin_init() {
		register_setting( 'debug-robot', 'debug_robot_host', array( $this, 'sanitize_host' ) );
		register_setting( 'debug-robot', 'debug_robot_port', 'intval' );
		register_setting( 'debug-robot', 'debug_robot_target', array( $this, 'sanitize_target' ) );
		register_setting( 'debug-robot', 'debug_robot_server', array( $this, 'sanitize_server' ) );
	}//end init

	public function admin_menu() {
		add_options_page( 'Debug Robot', 'Debug Robot', 'manage_options', 'debug-robot', array( $this, 'options_page' ) );

		add_settings_section( 'debug-robot', '', array( $this, 'settings_section' ), 'debug-robot' );
		add_settings_field( 'debug_robot_host', 'Host', array( $this, 'value_host' ), 'debug-robot', 'debug-robot' );
		add_settings_field( 'debug_robot_port', 'Port', array( $this, 'value_port' ), 'debug-robot', 'debug-robot' );
		add_settings_field( 'debug_robot_target', 'Target', array( $this, 'value_target' ), 'debug-robot', 'debug-robot' );
		add_settings_field( 'debug_robot_server', 'Server (optional)', array( $this, 'value_server' ), 'debug-robot', 'debug-robot' );
	}//end init

	public function options_page() {
		?>
		<div class="wrap">
			<?php screen_icon('options-general'); ?>
			<h2>Debug Robot Configuration</h2>
			<form action="options.php" method="post">
				<?php settings_fields( 'debug-robot' ); ?>
				<?php do_settings_sections( 'debug-robot' ); ?>
				<p>
					<input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"/>
				</p>
			</form>
		</div>
		<?php
	}//end options_page

	public function sanitize_host( $value ) {
		if ( ! $value['debug_robot_host'] ) {
			return '127.0.0.1';
		}//end if

		$value['debug_robot_host'] = preg_replace('/[^a-zA-Z0-9\.\-]/', '', $value['debug_robot_host'] );

		return $value;
	}//end sanitize_host

	public function sanitize_server( $value ) {
		if ( ! $value['debug_robot_server'] ) {
			return '';
		}//end if

		$value['debug_robot_server'] = preg_replace('/[^a-zA-Z0-9\.\-_\+@]/', '', $value['debug_robot_server'] );

		return $value;
	}//end sanitize_server

	public function sanitize_target( $value ) {
		if ( ! $value['debug_robot_target'] ) {
			return '';
		}//end if

		$value['debug_robot_target'] = preg_replace('/[^a-zA-Z0-9\.\-_\+@]/', '', $value['debug_robot_target'] );

		return $value;
	}//end sanitize_target

	public function settings_section() {
	}//end settings_section

	public function value_host( $args ) {
		$data = get_option( 'debug_robot_host', '127.0.0.1' );
		?>
			<input type="text" id="debug_robot_host" name="debug_robot_host" value="<?php echo esc_attr( $data ); ?>"/><br/>
			<span class="description">Host name to send UDP packets to (IP address that your jabber bot is running)</span>
		<?php
	}//end value_host

	public function value_port( $args ) {
		$data = get_option( 'debug_robot_port', 8888 );
		?>
			<input type="text" id="debug_robot_port" name="debug_robot_port" value="<?php echo esc_attr( $data ); ?>"/><br/>
			<span class="description">Port number on the above host that you wish to target UDP packets to</span>
		<?php
	}//end value_port

	public function value_server( $args ) {
		$data = get_option( 'debug_robot_server', '' );
		?>
			<input type="text" id="debug_robot_server" name="debug_robot_server" value="<?php echo esc_attr( $data ); ?>"/><br/>
			<span class="description">If you wish to identify your message as coming from something other than the hostname of your server, you can set that here.</span>
		<?php
	}//end value_server

	public function value_target( $args ) {
		$user = wp_get_current_user();

		$data = get_option( 'debug_robot_target', $user->data->user_email );
		?>
			<input type="text" id="debug_robot_target" name="debug_robot_target" value="<?php echo esc_attr( $data ); ?>"/><br/>
			<span class="description">Default email address the jabber bot should direct received messages to (this is NOT the email address of the jabberbot itself)</span>
		<?php
	}//end value_target
}//end class
