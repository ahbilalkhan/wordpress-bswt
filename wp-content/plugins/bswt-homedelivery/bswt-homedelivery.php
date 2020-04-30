<?php
/**
 * @package homedelivery
 */

/*
Plugin Name: BSWT Home Delivery
Plugin URI: https://baitussalam.org/
Description: Wordpress module for Home delivery service of donations
Version: 1.0.0
Author: Ahmed Bilal Khan
Author URI: https://github.com/ahbilalkhan/bswt-homedelivery/
License: GPLv2 or later
Text Domain: bswt-homedelivery
*/

defined('ABSPATH') or die;

if(!class_exists('HomeDelivery')){

 class HomeDelivery {
public $plugin;

    function __construct()
    {
        $this->plugin=plugin_basename(__FILE__);
    }
 
    function register(){
        //creates post option in side menu
        add_action('admin_enqueue_scripts', array($this,'enqueue'));
        add_action('admin_menu', array($this,'add_admin_pages'));
        add_filter("plugin_action_links_$this->plugin", array($this,'settings_link'));


    }

    public function settings_link($links){
        //add custom settings link
        $settings_link = '<a href="options-general.php?page=bswt_homedelivery">Settings</a>';
        array_push($links,$settings_link);
        return $links;
    }

    public function add_admin_pages(){
        add_menu_page('Home Delivery','Home Deivery','manage_options','homedelivery_plugin',array($this,'admin_index'),'dashicons-store', 110);
    }

    public function admin_index(){
        require_once plugin_dir_path(__FILE__).'templates/admin.php';
        
    }

    protected function create_post_type(){
        add_action('init', array( $this,'custom_post_type'));

    }

    function custom_post_type(){
        register_post_type( 'donation-request', ['public' => true, 'label' =>'Donation Request']);
    }

    function enqueue(){

        //enqueue all our scripts
        wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css',__FILE__));
        wp_enqueue_script('mypluginscript', plugins_url('/assets/myscript.js',__FILE__));

    }

 }
}

 if(class_exists('HomeDelivery')) {
     $homeDelivery = new HomeDelivery();
     $homeDelivery->register();
 }

 //activation
require_once plugin_dir_path(__FILE__).'include/activate-plugin.php';
register_activation_hook(__FILE__,array('ActivatePlugin','activate'));



 //deactivation
require_once plugin_dir_path(__FILE__).'include/deactivate-plugin.php';
register_deactivation_hook(__FILE__,array('DectivatePlugin','deactivate'));



if ( ! function_exists('create_donation_request') ) {

    // Register Custom Post Type
    function create_donation_request() {
    
        $labels = array(
            'name'                  => _x( 'Donation Requests', 'Post Type General Name', 'bswt' ),
            'singular_name'         => _x( 'Donation Request', 'Post Type Singular Name', 'bswt' ),
            'menu_name'             => __( 'Donation Request', 'bswt' ),
            'name_admin_bar'        => __( 'Donation Request', 'bswt' ),
            'archives'              => __( 'Item Archives', 'bswt' ),
            'attributes'            => __( 'Item Attributes', 'bswt' ),
            'parent_item_colon'     => __( 'Parent Item:', 'bswt' ),
            'all_items'             => __( 'All Items', 'bswt' ),
            'add_new_item'          => __( 'Add New Item', 'bswt' ),
            'add_new'               => __( 'Add New', 'bswt' ),
            'new_item'              => __( 'New Item', 'bswt' ),
            'edit_item'             => __( 'Edit Item', 'bswt' ),
            'update_item'           => __( 'Update Item', 'bswt' ),
            'view_item'             => __( 'View Item', 'bswt' ),
            'view_items'            => __( 'View Items', 'bswt' ),
            'search_items'          => __( 'Search Item', 'bswt' ),
            'not_found'             => __( 'Not found', 'bswt' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'bswt' ),
            'featured_image'        => __( 'Featured Image', 'bswt' ),
            'set_featured_image'    => __( 'Set featured image', 'bswt' ),
            'remove_featured_image' => __( 'Remove featured image', 'bswt' ),
            'use_featured_image'    => __( 'Use as featured image', 'bswt' ),
            'insert_into_item'      => __( 'Insert into item', 'bswt' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'bswt' ),
            'items_list'            => __( 'Items list', 'bswt' ),
            'items_list_navigation' => __( 'Items list navigation', 'bswt' ),
            'filter_items_list'     => __( 'Filter items list', 'bswt' ),
        );
        $args = array(
            'label'                 => __( 'Donation Request', 'bswt' ),
            'description'           => __( 'Donation Request', 'bswt' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'custom-fields' ),
            'taxonomies'            => array( 'category', 'post_tag' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( 'donation_request', $args );
    
    }
    add_action( 'init', 'create_donation_request', 0 );

    function searchfilter($query) {
 
        if ($query->is_search && !is_admin() ) {
            $query->set('post_type',array('create_donation_request'));
            $taxquery = array(array('taxonomy' => 'seacole_product_tags'));
        }
     
    return $query;
    }
     
    add_filter('pre_get_posts','searchfilter');
    
    }

    function ajax_form_scripts() {
        $translation_array = array(
            'ajax_url' => admin_url( 'admin-ajax.php' )
        );
        wp_localize_script( 'main', 'bswt-homedelivery', $translation_array );
    }
    
    add_action( 'wp_enqueue_scripts', 'ajax_form_scripts' );
    add_action( 'wp_ajax_set_form', 'set_form' );    //execute when wp logged in
    
   //To Save The Message In Custom Post Type
$new_post = array(
    'post_title'    => $name,
    'post_content'  => $message,
    'post_status'   => 'draft',           // Choose: publish, preview, future, draft, etc.
    'post_type' => 'ajaxform'  //'post',page' or use a custom post type if you want to
 );
 