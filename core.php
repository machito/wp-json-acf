<?php
/*
   Plugin Name: WP
   Plugin URI: https://github.com/machito/wp-json-api
   Version: 1.0
   Author: Michael Castilla
   Description: Custom WordPress JSON API
   License: GPLv3
*/

// Initialize ACF Options Page
if (function_exists('acf_add_options_page')) {
  acf_add_options_page();
}

// Templates Config
include_once('templates/config.php');
?>
