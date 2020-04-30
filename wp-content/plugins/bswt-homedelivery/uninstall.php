<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
};

function delete_bswt_delivery() {
    $posts = get_posts(
    array(
        'numberposts' => -1,
        'post_type' => 'donation-request',
        'post_status' => 'any',
    ));

    foreach ( $posts as $post ) {
    wp_delete_post( $post->ID, true );
}

global $wpdb;

$wpdb->query( "DELETE FROM wp_posts WHERE post_type ='donation-request' " );
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );

}

delete_bswt_delivery();