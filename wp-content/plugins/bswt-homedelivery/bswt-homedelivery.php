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
        wp_localize_script( 'main', 'form-post', $translation_array );

    }
    
    add_action( 'wp_enqueue_scripts', 'ajax_form_scripts' );
    add_action( 'wp_ajax_set_form', 'set_form' );    //execute when wp logged in
    
    function my_donation_scripts_function() {
        wp_register_script( "dontaion_script", plugin_dir_url(__FILE__).'assets/myscript.js', array('jquery'), false, true );
        //wp_register_script( "dontaion_script", get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), false, true );
    
    // localize the script to your domain name, so that you can reference the url to admin-ajax.php file easily
        wp_localize_script( 'dontaion_script', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));
    
        wp_enqueue_script( 'dontaion_script');
      }
      add_action('wp_enqueue_scripts','my_donation_scripts_function');
      
    function process_form(){
        print_r($_REQUEST);
        //$var= $_REQUEST['data']['cnic'];
        //echo $var;
        $data = array();
        foreach( $_REQUEST['data'] as $key => $value ){
            $data[$key] = $value;
        }
        echo 'DATA';
        print_r($data);

        set_form($data);
        //return true;
    }
    
      // THE AJAX ADD ACTIONS
    add_action( 'wp_ajax_set_form_values', 'process_form' );    //execute when wp logged in
    add_action( 'wp_ajax_nopriv_set_form_values', 'process_form'); //execute when logged out
  
    //To Save The Message In Custom Post Type
   function set_form($input) {
    global $wpdb; // this is how you get access to the database

        $donorFirstName= $input['donorFirstName'];
        $donorLastName = $input['donorLastName'];
       
        $name= $donorFirstName .' '. $donorLastName;
        $message="This is a test msg";
        $campaigns= $input['campaigns'];
        $donationAmount = $input['donationAmount'];
        $donorContact = $input['donorContact'];
        $donorEmail = $input['donorEmail'];
        $receiptNum = $input['receiptNum'];
        $receiptPhoto = $input['receiptPhoto'];

        $beneficiaryFirstName= $input['beneficiaryFirstName'];
        $beneficiaryLastName= $input['beneficiaryLastName'];
        $beneficiaryName= $beneficiaryFirstName .' '. $beneficiaryLastName;
        $beneficiaryContact= $input['beneficiaryContact'];
        $beneficiaryCnic= $input['cnic'];
        $beneficiaryAddress= $input['beneficiaryAddress'];
        $remainingBenefisharies= $input['remainingbeneficiaries'];
        


   $new_post = array(
    'post_title'    => $name,
    'post_content'  => $message,
    'post_category' => [3], 
    'campaign' => $campaigns,
    'donor-name' => $name,
    'donor-contact' => $donorContact,
    'donor-email' => $donorEmail,
    'receipt-number' => $receiptNum,
    'donation-amount' => $donationAmount,
    'receipt-photo' => $receiptPhoto,
    
    'beneficiary-name' => $beneficiaryName,
    'beneficiary-contact' => $beneficiaryContact,
    'beneficiary-address' => $beneficiaryAddress,
    'cnic'=> $beneficiaryCnic, 
    
    'remaining-benefisharies' =>$remainingBenefisharies,

    


    //'' => $,
    'post_status'   => 'draft',           // Choose: publish, preview, future, draft, etc.
    'post_type' => 'donation_request'  //'post',page' or use a custom post type if you want to
 );
 $pid = wp_insert_post($new_post); 
 echo($pid);
 print_r($pid);
 print_r($new_post);
 wp_set_post_terms( $pid, 'category', '3');
 add_post_meta($pid, 'campaign', $campaigns);
 add_post_meta($pid, 'donation-amount', $donationAmount);
 add_post_meta($pid, 'donor-contact', $donorContact);
 add_post_meta($pid, 'donor-email', $donorEmail);
 add_post_meta($pid, 'receipt-number', $receiptNum);
 add_post_meta($pid, 'receipt-photo', $receiptPhoto);
 add_post_meta($pid, 'donor-name', $name);
 
 add_post_meta($pid, 'beneficiary-name', $beneficiaryName);
 add_post_meta($pid, 'beneficiary-contact', $beneficiaryContact);
 add_post_meta($pid, 'cnic', $beneficiaryCnic);
 add_post_meta($pid, 'beneficiary-address', $beneficiaryAddress);
 add_post_meta($pid, 'remaining-benefisharies', $remainingBenefisharies);
// wp_die();
}
 do_action('wp_insert_post', 'set_form');
 add_action( 'wp_ajax_set_form', 'set_form' );    //execute when wp logged in

 
 
 function wp_cnic_validation( $errors )
{
    global $wpdb;
    $check = $wpdb->query( $wpdb->prepare("
    SELECT *
    FROM wp-postmeta
    WHERE meta_key = cnic AND meta_value = ".$_POST['cnic']) );


    if(!empty($check))
    {
       return true;
    }
    else
    {
       return false;
    }
}
add_filter( 'wp_add_post_validation', 'wp_cnic_validation' );



function wp_receipt_num_validation( $errors )
{
    global $wpdb;
    $check = $wpdb->query( $wpdb->prepare("
    SELECT *
    FROM wp-postmeta
    WHERE meta_key = Receipt Number AND meta_value = ".$_POST['receipt-number']) );


    if(!empty($check))
    {
       return true;
    }
    else
    {
       return false;
    }
}
add_filter( 'wp_add_post_validation', 'wp_receipt_num_validation' );