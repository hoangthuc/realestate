<?php
  require_once(plugin_dir_path(__FILE__).'components/enqueuing.php' );
require_once(plugin_dir_path(__FILE__).'components/metabox.php' );
require_once(plugin_dir_path(__FILE__).'components/ajax-update.php' );
require_once(plugin_dir_path(__FILE__).'components/readmethods.php' );

add_action( 'add_meta_boxes', 'fg_register_metabox' );
add_action( 'save_post', 'fg_save_perm_metadata', 1, 2 );
add_action( 'admin_enqueue_scripts', 'fg_enqueue_stuff' );
add_action( 'wp_ajax_fg_update_temp', 'fg_update_temp' );

// Hook the textdomain in
add_action( 'plugins_loaded', 'fg_load_textdomain' );
function fg_load_textdomain() {
    load_plugin_textdomain( 'featured-gallery', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}
?>
