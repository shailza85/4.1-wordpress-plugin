<?php
/**
 * Enqueue theme stylesheets and scripts.
 */
add_action( 'wp_enqueue_scripts', function () {
  // Get our JS ready to output in the <head> via wp_head() (see header.php.)
  wp_enqueue_script(
    'techcareers-plugin-calc-scripts', // Our new name for this script file.
    TECHCAREERS_CALC_PLUGIN_URL.'/assets/js/scripts.js', // URL / path to your script.
    array(), // Does your script depend on other JS libraries/files?
    strftime( TECHCAREERS_CALC_PLUGIN_URL.'/assets/js/scripts.js' ), // Version number of this script.
    FALSE // Output in the "footer"? (Before </body> closing tag.)
  );
  // Get our CSS ready to output in the <head> via wp_head() (see header.php.)
  wp_enqueue_style(
    'techcareers-plugin-calc-styles', // Our new name for this stylesheet file.
    TECHCAREERS_CALC_PLUGIN_URL.'/assets/css/main.css', // URL / path to your styles.
    strftime( TECHCAREERS_CALC_PLUGIN_URL.'/assets/css/main.css' ), // Version number of this stylesheet.
    'all' // What sort of stylesheet (media query) is this?
  );
} );