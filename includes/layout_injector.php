<?php

/*
 * Plugin Name: Divi Layout Injector
 * Plugin URI:  http://www.sean-barton.co.uk
 * Description: A simple plugin to edit the global layouts in Divi. Replaces the footer string of text normally used for the Divi backlink/credit allowing you to add your own copyright/credit/etc. Also allows the header and pre-footer to be edited using the layout builder in Divi.
 * Author:      Sean Barton - Tortoise IT
 * Version:     1.0
 * Author URI:  http://www.sean-barton.co.uk
 */

add_action('plugins_loaded', 'sb_divi_fe_init');

function sb_divi_fe_init() {

	add_action('get_footer', 'sb_divi_fe_record_start');
	add_action('et_head_meta', 'sb_divi_fe_record_start');
	add_action('et_header_top', 'sb_divi_fe_header_end');
	add_action('wp_footer', 'sb_divi_fe_footer_end');
	add_action('admin_menu', 'sb_divi_fe_submenu');

	add_filter('the_content', 'sb_divi_fe_content');

	add_shortcode('sb_divi_date', 'sb_divi_date');
	add_shortcode('sb_divi_blogname', 'sb_divi_blogname');

	add_action('template_redirect', 'sb_divi_fe_404');
}

function sb_divi_date() {
	return date('Y');
}

function sb_divi_blogname() {
	return get_bloginfo('name');
}

function sb_divi_fe_record_start() {
	ob_start();
}

function sb_divi_fe_404() {
	if (is_404()) {
		if ($layout_404 = get_option('sb_divi_fe_404')) {
			get_header();
			echo do_shortcode('[et_pb_section global_module="' . $layout_404 . '"][/et_pb_section]');
			get_footer();
			exit();
		}
	}
}

function sb_divi_fe_can_show($show_when) {

	//echo '<pre>';
	//print_r($show_when);
	//echo '</pre>';

	if (is_archive()) {
		return false;
	}

	if (!$show_when) {
		return true; //show everywhere except archive pages
	}

	foreach (array_keys($show_when) as $when) {
		//echo $when . '<br />';

		switch ($when) {
			case 'home':
				if (is_home()) {
					return true;
				}
				break;
			case 'front_page':
				if (is_front_page()) {
					return true;
				}
				break;
			case 'page':
				if (is_page()) {
					return true;
				}
				break;
			case 'single':
				if (is_single()) {
					return true;
				}
				break;
			case '404':
				if (is_404()) {
					return true;
				}
				break;
		}
	}

	return false;
}

function sb_divi_fe_content($content) {

	$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

	if ($is_page_builder_used) {

		if ($pre_content_layout = get_option('sb_divi_fe_pre-content')) {
			if (sb_divi_fe_can_show(get_option('sb_divi_fe_applicable_pre-content'))) {
				if ($section = do_shortcode('[et_pb_section global_module="' . $pre_content_layout . '"][/et_pb_section]')) {
					$content = $section . $content; //prepend
				}
			}
		}

		if ($post_content_layout = get_option('sb_divi_fe_post-content')) {
			if (sb_divi_fe_can_show(get_option('sb_divi_fe_applicable_post-content'))) {
				if ($section = do_shortcode('[et_pb_section global_module="' . $post_content_layout . '"][/et_pb_section]')) {
					$content .= $section; //append
				}
			}
		}

	}

	return $content;
}

function sb_divi_fe_footer_end() {
	$footer = ob_get_clean();

	if ($footer_credit = trim(get_option('sb_divi_fe_content'))) {
		$footer = preg_replace("/<p[^>]+>.*?<\/p>/i", '<span class="sb_divi_fe">' . do_shortcode($footer_credit) . '</span>', $footer);
	}

	//<footer id="main-footer">
	if ($pre_footer_layout = get_option('sb_divi_fe_pre-footer')) {
		$section = do_shortcode('[et_pb_section global_module="' . $pre_footer_layout . '"][/et_pb_section]');
		$footer = str_replace("<footer", $section . '<footer', $footer); //crude but replaces the footer tag with the section and then reinstates the tag
	}

	echo $footer;
}

function sb_divi_fe_header_end() {
	$header = ob_get_clean();

	//<header
	if ($pre_header_layout = get_option('sb_divi_fe_pre-header')) {
		if (sb_divi_fe_can_show(get_option('sb_divi_fe_applicable_pre-header'))) {
			$section = do_shortcode('[et_pb_section global_module="' . $pre_header_layout . '"][/et_pb_section]');
			$header = str_replace("<header", $section . '<header', $header); //crude but replaces the header tag with the section and then reinstates the tag
		}
	}

	echo $header;
}

function sb_divi_fe_submenu() {
	add_submenu_page(
		'options-general.php',
		'Divi Layout Injector',
		'Divi Layout Injector',
		'manage_options',
		'sb_divi_fe',
		'sb_divi_fe_submenu_cb' );
}

function sb_divi_fe_submenu_cb() {

	$options = array(
		'front_page'=>'Homepage'
	, 'home'=>'Blog home'
	, 'page'=>'Pages'
	, 'single'=>'Posts'
	, '404'=>'404 Page'
	);

	echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
	echo '<h2>Divi Layout Injector</h2>';

	if (isset($_POST['sb_divi_fe_edit_submit'])) {
		update_option('sb_divi_fe_content', stripslashes($_POST['sb_divi_fe_editor']));
		update_option('sb_divi_fe_404', $_POST['sb_divi_fe_404']);
		update_option('sb_divi_fe_pre-footer', $_POST['sb_divi_fe_pre-footer']);
		update_option('sb_divi_fe_pre-header', $_POST['sb_divi_fe_pre-header']);
		update_option('sb_divi_fe_pre-content', $_POST['sb_divi_fe_pre-content']);
		update_option('sb_divi_fe_post-content', $_POST['sb_divi_fe_post-content']);
		update_option('sb_divi_fe_applicable_post-content', $_POST['sb_divi_fe_applicable_post-content']);
		update_option('sb_divi_fe_applicable_pre-content', $_POST['sb_divi_fe_applicable_pre-content']);
		update_option('sb_divi_fe_applicable_pre-header', $_POST['sb_divi_fe_applicable_pre-header']);

		echo '<div id="message" class="updated fade"><p>Layouts edited successfully</p></div>';
	}

	$content = get_option('sb_divi_fe_content');
	$editor_id = 'sb_divi_fe_editor';

	echo '<p>This plugin allows you to edit the footer of your divi site without having to edit any core files. You can use this shortcode [sb_divi_date] to populate the current year and [sb_divi_blogname] to populate the name of the site. You can also use any other system shortcode to create a message or links of your choice.</p>';
	echo '<p><strong>Copyright [sb_divi_date] [sb_divi_blogname].</strong></p>';

	echo '<form method="POST" style="padding: 0 20px;">';

	wp_editor( $content, $editor_id );

	echo '<h2>Layouts</h2>';
	echo '<p>A layout can be built within the Divi library using the page builder. You can then use these settings to include layouts at certain stages in the page globally. for instance if you wanted a consistent header on every page.. an image perhaps. then you would create a layout in the library and choose it by name here. This plugin will do the rest!</p>';

	if ($layouts = get_posts(array('post_type'=>'et_pb_layout', 'posts_per_page'=>-1))) {

		echo '<div style="border: 1px solid gray; padding: 20px; margin-bottom: 20px;">';

		echo '<h3>404 Layout</h3>';

		echo '<p><small>This is global unless specified below.</small></p>';
		echo '<select name="sb_divi_fe_404">';

		$layout_404 = get_option('sb_divi_fe_404');
		echo '<option value="">-- None --</option>';

		foreach ($layouts as $layout) {
			echo '<option ' . selected($layout->ID, $layout_404, false) . ' value="' . $layout->ID . '">' . $layout->post_title . '</option>';
		}

		echo '</select>';

		echo '</div>';

		echo '<div style="border: 1px solid gray; padding: 20px; margin-bottom: 20px;">';

		echo '<h3>Pre-Header Layout</h3>';

		echo '<p><small>This is global unless specified below. In order to use this the fixed navigation must be turned off within the Divi settings.</small></p>';
		echo '<select name="sb_divi_fe_pre-header">';

		$pre_header_layout = get_option('sb_divi_fe_pre-header');
		echo '<option value="">-- None --</option>';

		foreach ($layouts as $layout) {
			echo '<option ' . selected($layout->ID, $pre_header_layout, false) . ' value="' . $layout->ID . '">' . $layout->post_title . '</option>';
		}

		echo '</select>';

		echo '<p>Applicable on</p>';
		echo '<p><small>This controls where the layout will show. Leave these boxes blank to show everywhere</small></p>';

		echo '<p>';

		$selected = get_option('sb_divi_fe_applicable_pre-header', array());

		foreach ($options as $key=>$value) {
			echo '<label><input type="checkbox" name="sb_divi_fe_applicable_pre-header[' . $key . ']" ' . checked(1, (@$selected[$key] == 1), false) . ' value="1" /> ' . $value . '</label><br />';
		}
		echo '</p>';

		echo '</div>';

		echo '<div style="border: 1px solid gray; padding: 20px; margin-bottom: 20px;">';

		echo '<h3>Pre-Content Layout</h3>';

		echo '<p><small>This is global unless specified below</small></p>';
		echo '<select name="sb_divi_fe_pre-content">';

		$pre_footer_layout = get_option('sb_divi_fe_pre-content');
		echo '<option value="">-- None --</option>';

		foreach ($layouts as $layout) {
			echo '<option ' . selected($layout->ID, $pre_footer_layout, false) . ' value="' . $layout->ID . '">' . $layout->post_title . '</option>';
		}

		echo '</select>';

		echo '<p>Applicable on</p>';
		echo '<p><small>This controls where the layout will show. Leave these boxes blank to show everywhere</small></p>';

		echo '<p>';

		$selected = get_option('sb_divi_fe_applicable_pre-content', array());

		foreach ($options as $key=>$value) {
			echo '<label><input type="checkbox" name="sb_divi_fe_applicable_pre-content[' . $key . ']" ' . checked(1, (@$selected[$key] == 1), false) . ' value="1" /> ' . $value . '</label><br />';
		}
		echo '</p>';

		echo '</div>';

		echo '<div style="border: 1px solid gray; padding: 20px; margin-bottom: 20px;">';

		echo '<h3>Post-Content Layout</h3>';
		echo '<p><small>This is global unless specified below</small></p>';
		echo '<select name="sb_divi_fe_post-content">';

		$post_content_layout = get_option('sb_divi_fe_post-content');
		echo '<option value="">-- None --</option>';

		foreach ($layouts as $layout) {
			echo '<option ' . selected($layout->ID, $post_content_layout, false) . ' value="' . $layout->ID . '">' . $layout->post_title . '</option>';
		}

		echo '</select>';

		echo '<p>Applicable on</p>';
		echo '<p><small>This controls where the layout will show. Leave these boxes blank to show everywhere</small></p>';

		echo '<p>';

		$selected = get_option('sb_divi_fe_applicable_post-content', array());

		foreach ($options as $key=>$value) {
			echo '<label><input type="checkbox" name="sb_divi_fe_applicable_post-content[' . $key . ']" ' . checked(1, (@$selected[$key] == 1), false) . ' value="1" /> ' . $value . '</label><br />';
		}
		echo '</p>';

		echo '</div>';

		echo '<div style="border: 1px solid gray; padding: 20px; margin-bottom: 20px;">';

		echo '<h3>Post-Footer Layout</h3>';

		echo '<p><small>This is global.. adding it here will make it show on every page</small></p>';
		echo '<select name="sb_divi_fe_pre-footer">';

		$pre_footer_layout = get_option('sb_divi_fe_pre-footer');
		echo '<option value="">-- None --</option>';

		foreach ($layouts as $layout) {
			echo '<option ' . selected($layout->ID, $pre_footer_layout, true) . ' value="' . $layout->ID . '">' . $layout->post_title . '</option>';
		}

		echo '</select>';

		echo '</div>';

	}


	echo '<p id="submit"><input type="submit" name="sb_divi_fe_edit_submit" class="button-primary" value="Save Settings" /></p>';

	echo '</form>';

	echo '</div>';
}

?>