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
define( 'AW_DS_DEBUG', true );

function aw_debug( $data ) {
	if ( AW_DS_DEBUG ) {
		$file = plugin_dir_path( __FILE__ ) . 'awds.log.' . date( 'd-m-Y' ) . '.txt';
		if ( ! is_file( $file ) ) {
			file_put_contents( $file, '' );
		}
		$data_string = print_r( $data, true ) . "\n";
		file_put_contents( $file, $data_string, FILE_APPEND );
	}
}

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
			add_filter( 'et_epanel_layout_data', array( $this, 'et_epanel_layout_data' ) );
		}

		// add_action( 'init', array( $this, 'load_localisation' ), 0 );

		/**
		 * Inject social media icons into footer
		 */
		//add_action( 'et_head_meta', array( $this, 'ob_start' ) );
		//add_action( 'et_header_top', array( $this, 'ob_end' ) );
		//do_action( "get_template_part_{$slug}", $slug, $name );
		add_action( 'get_template_part_includes/social_icons', array( $this, 'get_social_icons' ), 10, 2 );

		/**
		 * Inject social media icons into footer
		 */
		//add_action( 'get_footer', array( $this, 'ob_start' ) );
		//add_action( 'wp_footer', array( $this, 'ob_end' ) );
		//echo apply_filters( 'et_html_top_header', $top_header );
		add_filter( 'et_html_top_header', array( $this, 'update_et_html_top_header' ) );

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
	 * Hooked into the et_epanel_layout_data filter
	 * Add additional social media options
	 *
	 * @param $options
	 *
	 * @return array
	 */
	public function et_epanel_layout_data( $options ) {

		$original_options = $options;

		$additional_options = array(
			'dribbble'  => 'Dribbble',
			'flikr'     => 'Flikr',
			'houzz'     => 'Houzz',
			'instagram' => 'Instagram',
			'linkedin'  => 'Linkedin',
			'myspace'   => 'MySpace',
			'meetup'    => 'Meetup',
			'pinterest' => 'Pinterest',
			'podcast'   => 'Podcast',
			'tumblr'    => 'Tumblr',
			'skype'     => 'Skype',
			'yelp'      => 'Yelp',
			'youtube'   => 'YouTube',
			'vimeo'     => 'Vimeo',
			'vine'      => 'Vine',
		);

		$new_options = array();

		foreach ( $original_options as $option ) {

			$new_options[] = $option;

			if ( ! isset( $option['id'] ) ) {
				continue;
			}

			if ( 'divi_show_google_icon' === $option['id'] ) {

				foreach ( $additional_options as $option_name => $option_title ) {
					$new_options[] = array(
						'name' => sprintf(
							/* translators: %s: option title */
							esc_html__( 'Show %s Icon', 'divi' ),
							$option_title
						),
						'id'   => 'divi_show_' . $option_name . '_icon',
						'type' => 'checkbox',
						'std'  => 'on',
						'desc' => sprintf(
							/* translators: %s: option title */
							esc_html__( 'Here you can choose to display the %s Icon on your homepage', 'divi' ),
							$option_title
						),
					);
				}
			}

			if ( 'divi_google_url' === $option['id'] ) {

				foreach ( $additional_options as $option_name => $option_title ) {
					$new_options[] = array(
						'name'            => sprintf(
							/* translators: %s: option title */
							esc_html__( '%s Url', 'divi' ),
							$option_title
						),
						'id'              => 'divi_' . $option_name . '_url',
						'std'             => '#',
						'type'            => 'text',
						'validation_type' => 'url',
						'desc'            => sprintf(
							/* translators: %s: option title */
							esc_html__( 'Enter your  %s Url', 'divi' ),
							$option_title
						),
					);
				}
			}
		}

		$options = $new_options;
		return $options;
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

	public function update_et_html_top_header( $top_header ) {
		$social_icons = $this->get_social_icons();
		$top_header   = preg_replace( '/<ul class=\"et-social-icons\">.*?<\/ul>/is', $social_icons, $top_header );

		return $top_header;
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
