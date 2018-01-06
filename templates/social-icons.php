<?php
/**
 * Created by PhpStorm.
 * User: jonathan
 * Date: 2018/01/06
 * Time: 11:03 PM
 */
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
