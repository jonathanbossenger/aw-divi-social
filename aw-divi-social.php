<?php
/*
 * Plugin Name: AW Divi Social
 * Version: 1.3
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

define( 'AW_DS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'AW_DS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'AW_DS_ASSSETS_URL', plugin_dir_url( __FILE__ ) . '/assets/' );

add_action( 'wp_enqueue_scripts', 'aw_divi_social_enqueue_styles' );
function aw_divi_social_enqueue_styles () {
	wp_enqueue_style( 'font-awesome', AW_DS_ASSSETS_URL . 'font-awesome/fontawesome-all.min.css' );

}

if ( ! function_exists( 'aw_ds_load_core_options' ) ) {
	function aw_ds_load_core_options() {
		require_once AW_DS_PLUGIN_PATH . 'options_divi_social.php';
	}
}
add_action('admin_init', 'aw_ds_load_core_options', 11 );

function aw_ds_ob_start() {
	ob_start();
}

function aw_ds_ob_end() {
	$content = ob_get_clean();
	$social_icons = aw_ds_get_social_icons();
	$content = preg_replace("/<ul class=\"et-social-icons\">.*?<\/ul>/is", $social_icons, $content);
	echo $content;
}

function aw_ds_get_social_icons() {

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

add_action('get_footer', 'aw_ds_ob_start');
add_action('wp_footer', 'aw_ds_ob_end');

add_action('et_head_meta', 'aw_ds_ob_start');
add_action('et_header_top', 'aw_ds_ob_end');