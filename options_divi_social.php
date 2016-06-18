<?php
global $epanelMainTabs, $themename, $shortname, $options;
$original_options = $options;

$additional_options = array(
    'dribbble' => 'Dribbble',
    'flikr' => 'Flikr',
    'houzz' => 'Houzz',
    'instagram' => 'Instagram',
    'linkedin' => 'Linkedin',
    'myspace' => 'MySpace',
    'pinterest' => 'Pinterest',
    'podcast' => 'Podcast',
    'tumblr' => 'Tumblr',
    'skype' => 'Skype',
    'youtube' => 'YouTube',
    'vimeo' => 'Vimeo',
    'vine' => 'Vine',
);

foreach ($original_options as $option) {

    $new_options[] = $option;

    if (!isset($option['id'])) {
        continue;
    }

    if ('divi_show_google_icon' == $option['id']) {

        foreach ( $additional_options as $option_name => $option_title ) {
            $new_options[] = array("name" => esc_html__("Show " . $option_title . " Icon", $themename),
                "id" => $shortname . "_show_" . $option_name . "_icon",
                "type" => "checkbox",
                "std" => "on",
                "desc" => esc_html__("Here you can choose to display the " . $option_title . " Icon on your homepage. ", $themename));
        }

    }

    if ('divi_google_url' == $option['id']) {

        foreach ( $additional_options as $option_name => $option_title ) {
            $new_options[] = array("name" => esc_html__( $option_title . " Url", $themename),
                "id" => $shortname . "_" . $option_name . "_url",
                "std" => "#",
                "type" => "text",
                "validation_type" => "url",
                "desc" => esc_html__("Enter your " . $option_title . " URL.", $themename));
        }

    }
}

$options = array();
$options = $new_options;