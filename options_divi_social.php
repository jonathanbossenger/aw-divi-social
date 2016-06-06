<?php
global $epanelMainTabs, $themename, $shortname, $options;
$original_options = $options;

foreach ($original_options as $option){

	$new_options[] = $option;

	if ( 'divi_show_google_icon' == $option['id'] ) {

		$new_options[] = array( "name" =>esc_html__( "Show LinkedIn Icon", $themename ),
				"id" => $shortname."_show_linkedin_icon",
				"type" => "checkbox",
				"std" => "on",
				"desc" =>esc_html__( "Here you can choose to display the LinkedIn Icon on your homepage. ", $themename ) );

		$new_options[] = array( "name" =>esc_html__( "Show Pinterest Icon", $themename ),
				"id" => $shortname."_show_pinterest_icon",
				"type" => "checkbox",
				"std" => "on",
				"desc" =>esc_html__( "Here you can choose to display the Pinterest Icon on your homepage. ", $themename ) );

		$new_options[] = array( "name" =>esc_html__( "Show Tumblr Icon", $themename ),
				"id" => $shortname."_show_tumblr_icon",
				"type" => "checkbox",
				"std" => "on",
				"desc" =>esc_html__( "Here you can choose to display the Tumblr Icon on your homepage. ", $themename ) );

		$new_options[] = array( "name" =>esc_html__( "Show Instagram Icon", $themename ),
				"id" => $shortname."_show_instagram_icon",
				"type" => "checkbox",
				"std" => "on",
				"desc" =>esc_html__( "Here you can choose to display the Instagram Icon on your homepage. ", $themename ) );

		$new_options[] = array( "name" =>esc_html__( "Show Flikr Icon", $themename ),
				"id" => $shortname."_show_flikr_icon",
				"type" => "checkbox",
				"std" => "on",
				"desc" =>esc_html__( "Here you can choose to display the Flikr Icon on your homepage. ", $themename ) );
	}

	if ( 'divi_google_url' == $option['id'] ) {
		$new_options[] = array( "name" =>esc_html__( "LinkedIn Profile Url", $themename ),
				"id" => $shortname."_linkedin_url",
				"std" => "#",
				"type" => "text",
				"validation_type" => "url",
				"desc" =>esc_html__( "Enter the URL of your LinkedIn Profile. ", $themename ) );

		$new_options[] = array( "name" =>esc_html__( "Pinterest Profile Url", $themename ),
				"id" => $shortname."_pinterest_url",
				"std" => "#",
				"type" => "text",
				"validation_type" => "url",
				"desc" =>esc_html__( "Enter the URL of your Pinterest Profile. ", $themename ) );

		$new_options[] = array( "name" =>esc_html__( "Tumblr Profile Url", $themename ),
				"id" => $shortname."_tumblr_url",
				"std" => "#",
				"type" => "text",
				"validation_type" => "url",
				"desc" =>esc_html__( "Enter the URL of your Tumblr Profile. ", $themename ) );

		$new_options[] = array( "name" =>esc_html__( "Instagram Profile Url", $themename ),
				"id" => $shortname."_instagram_url",
				"std" => "#",
				"type" => "text",
				"validation_type" => "url",
				"desc" =>esc_html__( "Enter the URL of your Instagram Profile. ", $themename ) );

		$new_options[] = array( "name" =>esc_html__( "Flikr Profile Url", $themename ),
				"id" => $shortname."_flikr_url",
				"std" => "#",
				"type" => "text",
				"validation_type" => "url",
				"desc" =>esc_html__( "Enter the URL of your Flikr Profile. ", $themename ) );
	}
}

$options = array();
$options = $new_options;