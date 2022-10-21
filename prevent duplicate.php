<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'sydney-bootstrap' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

/**
 * Filter custom list of Coins into Importer
 *
 * @since 1.0
 */

function child_theme_coins() {
	return array(
		'3'   => 'XAU',
	);
}

add_filter( 'cryptowp_coins', 'child_theme_coins' );




// Check mail address already in Database - start

function is_already_submitted($formPostId, $fieldName, $fieldValue) {

    global $wpdb;

    /*We make a select in the table where the contacts are recorded, checking if the email informed already exists on today's date */

    $entry = $wpdb->get_results( "SELECT * FROM wp_cf7_vdata_entry WHERE value LIKE '%$fieldValue%' AND cf7_id = '$formPostId'" );
    
    // If the select query in the database is positive (the email exists on the current date), it returns the error in the form, in the email field, not sending

    $found = false;
    if (!empty($entry)) {
        $found = true;
    }
    return $found;
}

function my_validate_email($result, $tag) {
    $formPostId = '699'; // Change to ID of the form containing this field
    $fieldName = 'your-email'; // Change to your form's unique field name
    $errorMessage = 'This email address is already registered'; // Change to your error message
    $name = $tag['name'];
    if ($name == $fieldName) {
        if (is_already_submitted($formPostId, $fieldName, $_POST[$name])) {
            $result->invalidate($tag, $errorMessage);
        }
    }
    return $result;
}

add_filter('wpcf7_validate_email*', 'my_validate_email', 10, 2);

// Check mail address already in Database - end

?>