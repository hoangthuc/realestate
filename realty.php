<?php
  /*
Plugin Name: Plugin Bất động sản
Description: You can create wordpress user listing on front page. A search functionality will give your visitor more comfort in finding any user.Visitor can also see more information by click on Visit info link and popup will show with admin selected fields. Short code: [wp_squares]
Version: 3.9
Author: HOANG THUC
Author URI: http://www.hoangthuc.com
Text Domain: wa_real_estate
**/

define('ACME_PLUGIN_LISENCE_KEY', get_site_url());
define('real_URL', WP_PLUGIN_URL.'/wa_real_estate/');
define('FILE_URL', dirname(__FILE__));
add_action('admin_menu', 'my_realty_menu');

function my_realty_menu() {
     $tmp = basename(dirname(__FILE__)); // Plugin folder
        add_menu_page('Statistics Video','Bất động sản',8,$tmp.'/option.php');
        add_submenu_page($tmp.'/option.php','Bất động sản','Setting',8,$tmp.'/option.php');
}
function realty_admin_scripts_and_styles()
{
        wp_enqueue_style( 'bootstrap_admin', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/css/bootstrap_admin.css', array() );
        wp_enqueue_style( 'bootstrap-formhelpers.min', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/css/bootstrap-formhelpers.min.css', array() );
        wp_enqueue_style( 'style', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/css/style.css', array() );
        wp_enqueue_script('bootstrap.min', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/js/bootstrap.min.js', array() );
        wp_enqueue_script('bootstrap-formhelpers.min', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/js/bootstrap-formhelpers.min.js', array() );
        wp_enqueue_script('jquery.maskMoney.min', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/js/jquery.maskMoney.min.js', array() );

        wp_enqueue_script('custom', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/js/custom.js', array() );
}
add_action( 'wp_HT_realty_admin', 'realty_admin_scripts_and_styles' );

function realty_option_scripts_and_styles()
{
        wp_enqueue_style( 'bootstrap.min', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/css/bootstrap_admin.css', array() );
        wp_enqueue_style( 'bootstrap-formhelpers.min', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/css/bootstrap-formhelpers.min.css', array() );
        wp_enqueue_style( 'bootstrap-tagsinput', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/css/bootstrap-tagsinput.css', array() );
        wp_enqueue_style( 'style', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/css/style.css', array() );
        wp_enqueue_script('bootstrap.min', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/js/bootstrap.min.js', array() );
        wp_enqueue_script('bootstrap-formhelpers.min', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/js/bootstrap-formhelpers.min.js', array() );
        wp_enqueue_script('bootstrap-tagsinput', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/js/bootstrap-tagsinput.js', array() );
        wp_enqueue_script('angular.min.js', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/js/angular.min.js', array() );
        wp_enqueue_script('tagsinput-angular', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/js/bootstrap-tagsinput-angular.js', array() );
}
add_action( 'wp_HT_realty_option', 'realty_option_scripts_and_styles' );






function show_script_style_realtyHT(){
 wp_enqueue_style( 'bootstrap.min', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/css/bootstrap.min.css', array() );
 wp_enqueue_style( 'bootstrap-theme.min', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/css/bootstrap-theme.min.css', array() );
        wp_enqueue_style( 'bootstrap-formhelpers.min', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/css/bootstrap-formhelpers.min.css', array() );
    wp_enqueue_style( 'wa_real_estate', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/css/wa_real_estate.css', array() );

    wp_enqueue_script('jquery-1.11.3.min', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/js/jquery-1.11.3.min.js', array() );
    wp_enqueue_script('bootstrap.min', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/js/bootstrap.min.js', array() );
        wp_enqueue_script('bootstrap-formhelpers.min', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/js/bootstrap-formhelpers.min.js', array() );
   wp_enqueue_script('wa_real_estate', WP_PLUGIN_URL . '/wa_real_estate/bootstrap/js/wa_real_estate.js', array() );

}
add_action( 'wp_enqueue_scripts', 'show_script_style_realtyHT' );



function script_style_single_realtyHT(){
 wp_enqueue_style( 'flexslider', WP_PLUGIN_URL . '/wa_real_estate/libarary/woothemes-FlexSlider/flexslider.css', array() );
 wp_enqueue_style( 'slide-single', WP_PLUGIN_URL . '/wa_real_estate/libarary/woothemes-FlexSlider/slide-single.css', array() );

   wp_enqueue_script('jquery.flexslider-min', WP_PLUGIN_URL . '/wa_real_estate/libarary/woothemes-FlexSlider/jquery.flexslider-min.js', array() );
   wp_enqueue_script('slide-single', WP_PLUGIN_URL . '/wa_real_estate/libarary/woothemes-FlexSlider/slide-single.js', array() );
    
}
add_action( 'wp_single_nha_dat', 'script_style_single_realtyHT' );



include_once('function.php');
include_once('post_type/post_type.php');
include_once('gallery/gallery.php');
require_once 'securimage/securimage.php';

function get_custom_post_type_single($single_template) {
     global $post;
     if ($post->post_type == 'nha_dat') {
          $single_template = dirname( __FILE__ ) . '/single-nha_dat.php';
     }
     return $single_template;
}
// add_filter( 'single_template', 'get_custom_post_type_single' );

function realty_archive($archive_template){
        global $wpdb;
        $archive =$wpdb->last_result;
    if ( $archive[0]->taxonomy==  'bat_dong_san' || is_post_type_archive('nha_dat') ) {
          $archive_template = dirname( __FILE__ ) . '/archive-nha_dat.php';
    }
     return $archive_template;
}
add_filter( "archive_template", "realty_archive" ) ;


//add_filter( 'page_template', 'wpa3396_page_template' );
function wpa3396_page_template( $page_template )
{
    $post = get_post(get_option('pages_search'));
    $slug = $post->post_name;
    $link_search_pages = ($slug)?$slug:'tim-kiem-bds';
    if ( is_page( $link_search_pages ) ) {
        $page_template = dirname( __FILE__ ) . '/templates/template-archive-search.php';
    }
    return $page_template;
}

function template_chooser($template)
{
    global $wp_query;
    $post_type = get_query_var('post_type');
    if( $wp_query->is_search && $post_type == 'nha_dat' )
    {
        $template = dirname( __FILE__ ) .'/archive-search.php';  //  redirect to archive-search.php
    }
    return $template;
}
//add_filter('template_include', 'template_chooser');

