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

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'AW_DS_VERSION', '2.0.0' );

class AW_Divi_Social_Media {

    /**
     * The single instance of WordPress_Plugin_Template.
     * @var 	object
     * @access  private
     * @since 	2.0.0
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
     * @return  void
     */
    public function __construct ( $file = '', $version = '1.0.0' ) {
        $this->_version = $version;
        $this->_token = 'aw_divi_social';
        // Load plugin environment variables
        $this->file = $file;
        $this->dir = dirname( $this->file );
        $this->assets_dir = trailingslashit( $this->dir ) . 'assets';
        $this->assets_url = esc_url( trailingslashit( plugins_url( '/assets/', $this->file ) ) );
        $this->script_suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        // Load frontend JS & CSS
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ), 10 );


        // Load API for generic admin functions
        if ( is_admin() ) {
            add_action('admin_init', array( $this, 'load_core_divi_options' ), 11 );
        }

        add_action( 'init', array( $this, 'load_localisation' ), 0 );

        /**
         * Inject social media icons into footer
         */
	    add_action( 'et_head_meta', array( $this, 'ob_start' ) );
	    add_action( 'et_header_top', array( $this, 'ob_end' ) );

        /**
         * Inject social media icons into footer
         */
        add_action('get_footer', array( $this, 'ob_start' ) );
        add_action('wp_footer', array( $this, 'ob_end' ) );


    }

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->_version );
	}

    /**
     * Load frontend CSS.
     * @access  public
     * @since   1.0.0
     * @return void
     */
    public function enqueue_styles () {
        wp_register_style( $this->_token . '-font-awesome', esc_url( $this->assets_url ) . 'font-awesome/fontawesome-all.min.css', array(), $this->_version );
        wp_enqueue_style( $this->_token . '-font-awesome' );
    }

    /**
     * Main WordPress_Plugin_Template Instance
     *
     * Ensures only one instance of WordPress_Plugin_Template is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @see WordPress_Plugin_Template()
     * @return Main WordPress_Plugin_Template instance
     */
    public static function instance ( $file = '', $version = '1.0.0' ) {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self( $file, $version );
        }
        return self::$_instance;
    }

    /**
     * Override Core Divi Social Media icons
     */
    private function load_core_divi_options(){
        require_once $this->dir . 'options_divi_social.php';
    }

	/**
	 * Start output buffering
	 */
    private function ob_start(){
	    ob_start();
    }

	/**
	 * End output buffering, replace default social media icons with updated icons and return updated content
	 */
    private function ob_end(){
	    $content = ob_get_clean();
	    $social_icons = $this->get_social_icons();
	    $content = preg_replace("/<ul class=\"et-social-icons\">.*?<\/ul>/is", $social_icons, $content);
	    echo $content;
    }

	/**
     * Get updated social media icons from database
     *
	 * @return string
	 */
	private function get_social_icons() {
		ob_start();
		?>
        <ul class="et-social-icons">
			<?php if ( 'on' === et_get_option( 'divi_show_dribbble_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-dribbble">
                    <a href="<?php echo esc_url( et_get_option( 'divi_dribbble_url', '#' ) ); ?>" class="icon">
                        <span><?php esc_html_e( 'Dribbble', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_facebook_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-facebook">
                    <a href="<?php echo esc_url( et_get_option( 'divi_facebook_url', '#' ) ); ?>" class="icon">
                        <span><?php esc_html_e( 'Facebook', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_flikr_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-flikr">
                    <a href="<?php echo esc_url( et_get_option( 'divi_flikr_url', '#' ) ); ?>" class="icon">
                        <span><?php esc_html_e( 'Flikr', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_google_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-google-plus">
                    <a href="<?php echo esc_url( et_get_option( 'divi_google_url', '#' ) ); ?>" class="icon">
                        <span><?php esc_html_e( 'Google', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_houzz_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-houzz">
                    <a href="<?php echo esc_url( et_get_option( 'divi_houzz_url', '#' ) ); ?>" class="icon">
                        <i class="fab fa-houzz"></i>
                        <span><?php esc_html_e( 'Houzz', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_instagram_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-instagram">
                    <a href="<?php echo esc_url( et_get_option( 'divi_instagram_url', '#' ) ); ?>" class="icon">
                        <span><?php esc_html_e( 'Instagram', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_linkedin_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-linkedin">
                    <a href="<?php echo esc_url( et_get_option( 'divi_linkedin_url', '#' ) ); ?>" class="icon">
                        <span><?php esc_html_e( 'LinkedIn', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_meetup_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-meetup">
                    <a href="<?php echo esc_url( et_get_option( 'divi_meetup_url', '#' ) ); ?>" class="icon">
                        <i class="fab fa-meetup"></i>
                        <span><?php esc_html_e( 'Meetup', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_myspace_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-myspace">
                    <a href="<?php echo esc_url( et_get_option( 'divi_myspace_url', '#' ) ); ?>" class="icon">
                        <span><?php esc_html_e( 'MySpace', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_pinterest_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-pinterest">
                    <a href="<?php echo esc_url( et_get_option( 'divi_pinterest_url', '#' ) ); ?>" class="icon">
                        <span><?php esc_html_e( 'Pinterest', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_twitter_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-twitter">
                    <a href="<?php echo esc_url( et_get_option( 'divi_twitter_url', '#' ) ); ?>" class="icon">
                        <span><?php esc_html_e( 'Twitter', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_tumblr_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-tumblr">
                    <a href="<?php echo esc_url( et_get_option( 'divi_tumblr_url', '#' ) ); ?>" class="icon">
                        <span><?php esc_html_e( 'Tumblr', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_skype_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-skype">
                    <a href="<?php echo esc_url( et_get_option( 'divi_skype_url', '#' ) ); ?>" class="icon">
                        <span><?php esc_html_e( 'Skype', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_yelp_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-yelp">
                    <a href="<?php echo esc_url( et_get_option( 'divi_yelp_url', '#' ) ); ?>" class="icon">
                        <i class="fa fa-yelp"></i>
                        <span><?php esc_html_e( 'Yelp', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_youtube_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-youtube">
                    <a href="<?php echo esc_url( et_get_option( 'divi_youtube_url', '#' ) ); ?>" class="icon">
                        <span><?php esc_html_e( 'YouTube', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_vimeo_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-vimeo">
                    <a href="<?php echo esc_url( et_get_option( 'divi_vimeo_url', '#' ) ); ?>" class="icon">
                        <span><?php esc_html_e( 'Vimeo', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_vine_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-vine">
                    <a href="<?php echo esc_url( et_get_option( 'divi_vine_url', '#' ) ); ?>" class="icon">
                        <i class="fa fa-vine"></i>
                        <span><?php esc_html_e( 'Vine', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_rss_icon', 'on' ) ) : ?>
				<?php
				$et_rss_url = '' !== et_get_option( 'divi_rss_url' )
					? et_get_option( 'divi_rss_url' )
					: get_bloginfo( 'rss2_url' );
				?>
                <li class="et-social-icon et-social-rss">
                    <a href="<?php echo esc_url( $et_rss_url ); ?>" class="icon">
                        <span><?php esc_html_e( 'RSS', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
			<?php if ( 'on' === et_get_option( 'divi_show_podcast_icon', 'on' ) ) : ?>
                <li class="et-social-icon et-social-podcast">
                    <a href="<?php echo esc_url( et_get_option( 'divi_podcast_url', '#' ) ); ?>" class="icon">
                        <i class="fa fa-headphones"></i>
                        <span><?php esc_html_e( 'Podcast', 'Divi' ); ?></span>
                    </a>
                </li>
			<?php endif; ?>
        </ul>
		<?php
		return ob_get_clean();
	}

}

function instantiate_aw_divi_social_media () {
    $instance = AW_Divi_Social_Media::instance( __FILE__, AW_DS_VERSION );
    return $instance;
}
$aw_divi_social_media = instantiate_aw_divi_social_media();
