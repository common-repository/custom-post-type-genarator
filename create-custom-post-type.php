<?php
/*
Plugin Name: Create Custom Post Type
Plugin URI:  http://www.neoromogroup.asia
Description: If you are looking to create custom post type and you are not too much familiar WordPress theme code then this plugin is for you. It can work like a charm for you.
Version:     1.0
Author:      anand23
Author URI:  https://profiles.wordpress.org/anand23
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages

*/
function dm_setup_post_type() {
    $maintitle = 'Custom Post';
    $new_title = sanitize_title($maintitle);
 
    $labels = array(
		'name'               => _x( $maintitle, 'post type general name', 'dm-custompost' ),
		'singular_name'      => _x( $maintitle, 'post type singular name', 'dm-custompost' ),
		'menu_name'          => _x( $maintitle, 'admin menu', 'dm-custompost' ),
		'name_admin_bar'     => _x( $maintitle, 'add new on admin bar', 'dm-custompost' ),
		'add_new'            => _x( 'Add New', $maintitle, 'dm-custompost' ),
		'add_new_item'       => __( 'Add New '.$maintitle, 'dm-custompost' ),
		'new_item'           => __( 'New '.$maintitle, 'dm-custompost' ),
		'edit_item'          => __( 'Edit '.$maintitle, 'dm-custompost' ),
		'view_item'          => __( 'View '.$maintitle, 'dm-custompost' ),
		'all_items'          => __( 'All '.$maintitle, 'dm-custompost' ),
		'search_items'       => __( 'Search '.$maintitle, 'dm-custompost' ),
		'parent_item_colon'  => __( 'Parent '.$maintitle, 'dm-custompost' ),
		'not_found'          => __( 'No '.$maintitle.' found.', 'dm-custompost' ),
		'not_found_in_trash' => __( 'No '.$maintitle.' found in Trash.', 'dm-custompost' )
	);

	$args = array(
		'labels'             => $labels,
      'description'        => __( 'Description.', 'dm-custompost' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $new_title ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title' )
	);

	register_post_type( $new_title , $args );
	
   $loop = new WP_Query( array( 'post_type' => $new_title, 'posts_per_page' => -1 ) ); 

 	while ( $loop->have_posts() ) : $loop->the_post(); 
	$title = get_the_title();
 	$new_title = sanitize_title($title);
    
 	$labels = array(
		'name'               => _x( $title, 'post type general name', 'dm-custompost' ),
		'singular_name'      => _x( $title, 'post type singular name', 'dm-custompost' ),
		'menu_name'          => _x( $title, 'admin menu', 'dm-custompost' ),
		'name_admin_bar'     => _x( $title, 'add new on admin bar', 'dm-custompost' ),
		'add_new'            => _x( 'Add New', $title, 'dm-custompost' ),
		'add_new_item'       => __( 'Add New '.$title, 'dm-custompost' ),
		'new_item'           => __( 'New '.$title, 'dm-custompost' ),
		'edit_item'          => __( 'Edit '.$title, 'dm-custompost' ),
		'view_item'          => __( 'View '.$title, 'dm-custompost' ),
		'all_items'          => __( 'All '.$title, 'dm-custompost' ),
		'search_items'       => __( 'Search '.$title, 'dm-custompost' ),
		'parent_item_colon'  => __( 'Parent '.$title, 'dm-custompost' ),
		'not_found'          => __( 'No '.$title.' found.', 'dm-custompost' ),
		'not_found_in_trash' => __( 'No '.$title.' found in Trash.', 'dm-custompost' )
	);

	$args = array(
		'labels'             => $labels,
      'description'        => __( 'Description.', 'dm-custompost' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $new_title ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( $new_title , $args );
	
endwhile;  
}
add_action( 'init', 'dm_setup_post_type' );
 
function dm_install() {
 
    dm_setup_post_type();

    flush_rewrite_rules();
 
}
register_activation_hook( __FILE__, 'dm_install' );


function dm_deactivation() {
    flush_rewrite_rules();
 
}
register_deactivation_hook( __FILE__, 'dm_deactivation' );
