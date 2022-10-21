<?php

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