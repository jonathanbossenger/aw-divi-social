<?php
global $epanelMainTabs, $themename, $shortname, $options;
$original_options = $options;

foreach ($original_options as $option) {

    $new_options[] = $option;

    if (!isset($option['id'])) {
        continue;
    }

    if ('divi_show_google_icon' == $option['id']) {

        $new_options[] = array("name" => esc_html__("Show LinkedIn Icon", $themename),
            "id" => $shortname . "_show_linkedin_icon",
            "type" => "checkbox",
            "std" => "on",
            "desc" => esc_html__("Here you can choose to display the LinkedIn Icon on your homepage. ", $themename));

        $new_options[] = array("name" => esc_html__("Show Pinterest Icon", $themename),
            "id" => $shortname . "_show_pinterest_icon",
            "type" => "checkbox",
            "std" => "on",
            "desc" => esc_html__("Here you can choose to display the Pinterest Icon on your homepage. ", $themename));

        $new_options[] = array("name" => esc_html__("Show Tumblr Icon", $themename),
            "id" => $shortname . "_show_tumblr_icon",
            "type" => "checkbox",
            "std" => "on",
            "desc" => esc_html__("Here you can choose to display the Tumblr Icon on your homepage. ", $themename));

        $new_options[] = array("name" => esc_html__("Show Instagram Icon", $themename),
            "id" => $shortname . "_show_instagram_icon",
            "type" => "checkbox",
            "std" => "on",
            "desc" => esc_html__("Here you can choose to display the Instagram Icon on your homepage. ", $themename));

        $new_options[] = array("name" => esc_html__("Show Flikr Icon", $themename),
            "id" => $shortname . "_show_flikr_icon",
            "type" => "checkbox",
            "std" => "on",
            "desc" => esc_html__("Here you can choose to display the Flikr Icon on your homepage. ", $themename));

        $new_options[] = array("name" => esc_html__("Show Houzz Icon", $themename),
            "id" => $shortname . "_show_houzz_icon",
            "type" => "checkbox",
            "std" => "on",
            "desc" => esc_html__("Here you can choose to display the Houzz Icon on your homepage. ", $themename));
        
        $new_options[] = array("name" => esc_html__("Show YouTube Icon", $themename),
            "id" => $shortname . "_show_youtube_icon",
            "type" => "checkbox",
            "std" => "on",
            "desc" => esc_html__("Here you can choose to display the YouTube Icon on your homepage. ", $themename));

        $new_options[] = array("name" => esc_html__("Show Podcast Icon", $themename),
            "id" => $shortname . "_show_podcast_icon",
            "type" => "checkbox",
            "std" => "on",
            "desc" => esc_html__("Here you can choose to display a Podcast Icon on your homepage. ", $themename));

    }

    if ('divi_google_url' == $option['id']) {
        $new_options[] = array("name" => esc_html__("LinkedIn Profile Url", $themename),
            "id" => $shortname . "_linkedin_url",
            "std" => "#",
            "type" => "text",
            "validation_type" => "url",
            "desc" => esc_html__("Enter the URL of your LinkedIn Profile. ", $themename));

        $new_options[] = array("name" => esc_html__("Pinterest Profile Url", $themename),
            "id" => $shortname . "_pinterest_url",
            "std" => "#",
            "type" => "text",
            "validation_type" => "url",
            "desc" => esc_html__("Enter the URL of your Pinterest Profile. ", $themename));

        $new_options[] = array("name" => esc_html__("Tumblr Profile Url", $themename),
            "id" => $shortname . "_tumblr_url",
            "std" => "#",
            "type" => "text",
            "validation_type" => "url",
            "desc" => esc_html__("Enter the URL of your Tumblr Profile. ", $themename));

        $new_options[] = array("name" => esc_html__("Instagram Profile Url", $themename),
            "id" => $shortname . "_instagram_url",
            "std" => "#",
            "type" => "text",
            "validation_type" => "url",
            "desc" => esc_html__("Enter the URL of your Instagram Profile. ", $themename));

        $new_options[] = array("name" => esc_html__("Flikr Profile Url", $themename),
            "id" => $shortname . "_flikr_url",
            "std" => "#",
            "type" => "text",
            "validation_type" => "url",
            "desc" => esc_html__("Enter the URL of your Flikr Profile. ", $themename));

        $new_options[] = array("name" => esc_html__("Houzz Url", $themename),
            "id" => $shortname . "_houzz_url",
            "std" => "#",
            "type" => "text",
            "validation_type" => "url",
            "desc" => esc_html__("Enter the URL of your Houzz Profile. ", $themename));

        $new_options[] = array("name" => esc_html__("YouTube Channel Url", $themename),
            "id" => $shortname . "_youtube_url",
            "std" => "#",
            "type" => "text",
            "validation_type" => "url",
            "desc" => esc_html__("Enter the URL of your YouTube Channel. ", $themename));

        $new_options[] = array("name" => esc_html__("Podcast Url", $themename),
            "id" => $shortname . "_podcast_url",
            "std" => "#",
            "type" => "text",
            "validation_type" => "url",
            "desc" => esc_html__("Enter the URL of your Podcast. ", $themename));
    }
}

$options = array();
$options = $new_options;