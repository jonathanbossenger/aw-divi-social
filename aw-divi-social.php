<?php
/*
 * Plugin Name: AW Divi Social
 * Version: 1.0
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
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ('Divi' != get_template()) {
	wp_die('The Atlantic Wave Divi Social plugin will not work if your site\'s current theme is not Divi theme from Elegantthemes.com.');
}

define( 'AW_DS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'AW_DS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

if ( ! function_exists( 'et_load_core_options' ) ) {
	function et_load_core_options() {
		global $shortname;
		require_once get_template_directory() . esc_attr( "/options_{$shortname}.php" );
		require_once AW_DS_PLUGIN_PATH . 'options_divi_social.php';
	}
}

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

		<?php if ( 'on' === et_get_option( 'divi_show_facebook_icon', 'on' ) ) : ?>
			<li class="et-social-icon et-social-facebook">
				<a href="<?php echo esc_url( et_get_option( 'divi_facebook_url', '#' ) ); ?>" class="icon">
					<span><?php esc_html_e( 'Facebook', 'Divi' ); ?></span>
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

		<?php if ( 'on' === et_get_option( 'divi_show_google_icon', 'on' ) ) : ?>
			<li class="et-social-icon et-social-google-plus">
				<a href="<?php echo esc_url( et_get_option( 'divi_google_url', '#' ) ); ?>" class="icon">
					<span><?php esc_html_e( 'Google', 'Divi' ); ?></span>
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

		<?php if ( 'on' === et_get_option( 'divi_show_pinterest_icon', 'on' ) ) : ?>
			<li class="et-social-icon et-social-pinterest">
				<a href="<?php echo esc_url( et_get_option( 'divi_pinterest_url', '#' ) ); ?>" class="icon">
					<span><?php esc_html_e( 'Pinterest', 'Divi' ); ?></span>
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

		<?php if ( 'on' === et_get_option( 'divi_show_instagram_icon', 'on' ) ) : ?>
			<li class="et-social-icon et-social-instagram">
				<a href="<?php echo esc_url( et_get_option( 'divi_instagram_url', '#' ) ); ?>" class="icon">
					<span><?php esc_html_e( 'Instagram', 'Divi' ); ?></span>
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

	</ul>

	<?php

	return ob_get_clean();

}

add_action('get_footer', 'aw_ds_ob_start');
add_action('wp_footer', 'aw_ds_ob_end');

add_action('et_head_meta', 'aw_ds_ob_start');
add_action('et_header_top', 'aw_ds_ob_end');