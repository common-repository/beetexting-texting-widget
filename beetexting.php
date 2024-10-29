<?php
 /**
 * Plugin Name:      BEETEXTING Texting Widget
 * Plugin URI:        https://beetexting.com/
 * Description:       Adds a simple texting widget on the website. Desktop and mobile responsive.
 * Version:           1.0.2
 * Text Domain:      beetexting-texting-widget
 * btwp_:             beetexting texting widget plugin
 * Author:            The Beetexting Team
 * Author URI:      https://beetexting.com/
 * Copyright: (c) 2020 Beetexting
 * License: GNU General Public License v2.0
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

 // Exit if accessed directly

 if(!defined('ABSPATH')) {
    exit;
}

function btwp_callback_for_setting_up_scripts() {
    wp_register_style( 'beetexting-styles', plugins_url( '/css/main.css', __FILE__));
    wp_enqueue_style( 'beetexting-styles' );
    wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'beetexting-main', plugins_url( '/js/main.js', __FILE__ ));
}

add_action('wp_enqueue_scripts', 'btwp_callback_for_setting_up_scripts');
add_action('admin_init', 'btwp_callback_for_setting_up_scripts');

add_filter("plugin_action_link_beetexting/beetexting.php", '<a href="/"></a>');
?>
<?php
add_action('admin_menu', 'btwp_my_admin_menu');

function btwp_my_admin_menu () {
	
    add_menu_page('BEETEXTING', 'BEETEXTING', 'manage_options',
 'beetexting_texting_widget', 'btwp_mt_settings_page',plugins_url('/assets/bee-logo-sm.png', __FILE__));
}

// mt_settings_page() displays the page content for the Test Settings submenu
function btwp_mt_settings_page() {
    echo '<h2>' . esc_html__( 'BEETEXTING Settings', 'beetexting-texting-widget' ) . '</h2>';
	include_once('beetexting_settings_page.php');
}
?>
<?php

function btwp_texting_widget() {

    // Retrieve options from WordPress settings
$secondary_color = esc_attr(get_option('secondary_color'));
$footer_text = esc_html(get_option('footer_text'));
$phone_number = esc_attr(get_option('phone_number'));
$primary_color = esc_attr(get_option('primary_color'));

echo '<div class="desktop-texting-widget">
        <p class="desktop-message" style="background: ' . $secondary_color . ';">
            ' . $footer_text . '<br>
            <strong>' . $phone_number . '</strong>
        </p>
        <a id="desktop-trigger">
            <svg id="Capa_1" enable-background="new 0 0 511.096 511.096" height="512" viewBox="0 0 511.096 511.096" width="512" xmlns="http://www.w3.org/2000/svg" style="background: ' . $primary_color . ';"><g id="Speech_Bubble_48_"><g><path d="m74.414 480.548h-36.214l25.607-25.607c13.807-13.807 22.429-31.765 24.747-51.246-59.127-38.802-88.554-95.014-88.554-153.944 0-108.719 99.923-219.203 256.414-219.203 165.785 0 254.682 101.666 254.682 209.678 0 108.724-89.836 210.322-254.682 210.322-28.877 0-59.01-3.855-85.913-10.928-25.467 26.121-59.973 40.928-96.087 40.928z"/></g></g></svg>
        </a>
    </div>
  
    <div class="mobile-texting-widget">
        <a href="sms:' . $phone_number . '">
            <svg id="Capa_1" enable-background="new 0 0 511.096 511.096" height="512" viewBox="0 0 511.096 511.096" width="512" xmlns="http://www.w3.org/2000/svg" style="background: ' . $primary_color . ';"><g id="Speech_Bubble_48_"><g><path d="m74.414 480.548h-36.214l25.607-25.607c13.807-13.807 22.429-31.765 24.747-51.246-59.127-38.802-88.554-95.014-88.554-153.944 0-108.719 99.923-219.203 256.414-219.203 165.785 0 254.682 101.666 254.682 209.678 0 108.724-89.836 210.322-254.682 210.322-28.877 0-59.01-3.855-85.913-10.928-25.467 26.121-59.973 40.928-96.087 40.928z"/></g></g></svg>
        </a>
    </div>';
}

add_action( 'wp_footer', 'btwp_texting_widget' );

?>