<?php
/*
 * Plugin Name: AW Divi Social
 * Version: 2.0.0
 * Plugin URI: http://atlanticwave.co/
 * Description: Additional Social Media icons for your headers and footers
 * Author: Atlantic Wave
 * Author URI: http://atlanticwave.co/
 * Requires at least: 4.0
 * Tested up to: 4.0
 *
 * Text Domain: aw-divi-social
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Atlantic Wave
 * @since 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'AW_DS_VERSION', '2.0.0' );

class AW_Divi_Social_Media {

	/**
	 * The single instance of WordPress_Plugin_Template.
	 * @var     object
	 * @access  private
	 * @since   2.0.0
	 */
	private static $_instance = null;
	/**
	 * Settings class object
	 * @var     object
	 * @access  public
	 * @since   2.0.0
	 */
	public $settings = null;
	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   2.0.0
	 */
	public $_version;
	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   2.0.0
	 */
	public $_token;
	/**
	 * The main plugin file.
	 * @var     string
	 * @access  public
	 * @since   2.0.0
	 */
	public $file;
	/**
	 * The main plugin directory.
	 * @var     string
	 * @access  public
	 * @since   2.0.0
	 */
	public $dir;
	/**
	 * The plugin assets directory.
	 * @var     string
	 * @access  public
	 * @since   2.0.0
	 */
	public $assets_dir;
	/**
	 * The plugin assets URL.
	 * @var     string
	 * @access  public
	 * @since   2.0.0
	 */
	public $assets_url;
	/**
	 * Suffix for Javascripts.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $script_suffix;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 *
	 * @param   string $file
	 * @param   string $version
	 *
	 * @return  void
	 */
	public function __construct( $file = '', $version = '1.0.0' ) {
		$this->_version = $version;
		$this->_token   = 'aw_divi_social';
		// Load plugin environment variables
		$this->file          = $file;
		$this->dir           = dirname( $this->file );
		$this->assets_dir    = trailingslashit( $this->dir ) . 'assets';
		$this->assets_url    = esc_url( trailingslashit( plugins_url( '/assets/', $this->file ) ) );
		$this->script_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// Load frontend JS & CSS
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 10 );


		// Load API for generic admin functions
		if ( is_admin() ) {
			add_action( 'admin_init', array( $this, 'load_core_divi_options' ), 11 );
		}

		// add_action( 'init', array( $this, 'load_localisation' ), 0 );

		/**
		 * Inject social media icons into footer
		 */
		add_action( 'et_head_meta', array( $this, 'ob_start' ) );
		add_action( 'et_header_top', array( $this, 'ob_end' ) );

		/**
		 * Inject social media icons into footer
		 */
		add_action( 'get_footer', array( $this, 'ob_start' ) );
		add_action( 'wp_footer', array( $this, 'ob_end' ) );


	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
	}

	/**
	 * Load frontend CSS.
	 * @access  public
	 * @since   1.0.0
	 * @return void
	 */
	public function enqueue_styles() {
		wp_register_style( $this->_token . '-font-awesome', esc_url( $this->assets_url ) . 'font-awesome/fontawesome-all.min.css', array(), $this->_version );
		wp_enqueue_style( $this->_token . '-font-awesome' );
	}

	/**
	 * Main WordPress_Plugin_Template Instance
	 *
	 * Ensures only one instance of WordPress_Plugin_Template is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @param string $file
	 * @param string $version
	 *
	 * @static
	 * @see WordPress_Plugin_Template()
	 *
	 * @return object $_instance
	 */
	public static function instance( $file = '', $version = '1.0.0' ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self( $file, $version );
		}

		return self::$_instance;
	}

	/**
	 * Override Core Divi Social Media icons
	 */
	public function load_core_divi_options() {
		require_once $this->dir . 'options_divi_social.php';
	}

	/**
	 * Start output buffering
	 */
	private function ob_start() {
		ob_start();
	}

	/**
	 * End output buffering, replace default social media icons with updated icons and return updated content
	 */
	private function ob_end() {
		$content      = ob_get_clean();
		$social_icons = $this->get_social_icons();
		$content      = preg_replace( '/<ul class=\"et-social-icons\">.*?<\/ul>/is', $social_icons, $content );
		// @todo determine correct escaping function here
		echo $content;
	}

	/**
	 * Get updated social media icons from database
	 *
	 * @return string
	 */
	private function get_social_icons() {
		ob_start();
		require_once $this->dir . '/templates/social-icons.php';
		return ob_get_clean();
	}

}

function instantiate_aw_divi_social_media() {
	$instance = AW_Divi_Social_Media::instance( __FILE__, AW_DS_VERSION );

	return $instance;
}

$aw_divi_social_media = instantiate_aw_divi_social_media();
