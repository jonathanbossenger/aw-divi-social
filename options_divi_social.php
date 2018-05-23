<?php
global $epanelMainTabs, $themename, $shortname, $options;
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

foreach ( $original_options as $option ) {

	$new_options = array();

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
				'id'   => $shortname . '_show_' . $option_name . '_icon',
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
				'id'              => $shortname . '_' . $option_name . '_url',
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

$options = array();
$options = $new_options;
