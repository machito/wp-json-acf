<?php

// Set plugin path
if ( ! defined( 'RC_TC_BASE_FILE' ) )
    define( 'RC_TC_BASE_FILE', __FILE__ );
if ( ! defined( 'RC_TC_BASE_DIR' ) )
    define( 'RC_TC_BASE_DIR', dirname( RC_TC_BASE_FILE ) );
if ( ! defined( 'RC_TC_PLUGIN_URL' ) )
    define( 'RC_TC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Select the correct template in the plugin
function rc_tc_get_template_hierarchy( $template ) {
  $file = RC_TC_BASE_DIR . '/' . $template;
  return apply_filters('rc_repl_template_' . $template, $file);
}

// Use the template file located in the plugin
function rc_tc_template_chooser( $template ) {
  if (is_page('specials')) {
    return rc_tc_get_template_hierarchy('sample-api.php');
  }
}
add_filter('template_include', 'rc_tc_template_chooser');
