<?php
//Example of custom posttype creation .
//This file should be also included in / config / includes.php file to enable teh custom post type



/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
/*add_action ( 'init' , 'codex_book_init' );
function codex_book_init ()
{
	$labels = array(
		'name'               => _x ( 'Books' , 'post type general name' , 'your-plugin-textdomain' ) ,
		'singular_name'      => _x ( 'Book' , 'post type singular name' , 'your-plugin-textdomain' ) ,
		'menu_name'          => _x ( 'Books' , 'admin menu' , 'your-plugin-textdomain' ) ,
		'name_admin_bar'     => _x ( 'Book' , 'add new on admin bar' , 'your-plugin-textdomain' ) ,
		'add_new'            => _x ( 'Add New' , 'book' , 'your-plugin-textdomain' ) ,
		'add_new_item'       => __ ( 'Add New Book' , 'your-plugin-textdomain' ) ,
		'new_item'           => __ ( 'New Book' , 'your-plugin-textdomain' ) ,
		'edit_item'          => __ ( 'Edit Book' , 'your-plugin-textdomain' ) ,
		'view_item'          => __ ( 'View Book' , 'your-plugin-textdomain' ) ,
		'all_items'          => __ ( 'All Books' , 'your-plugin-textdomain' ) ,
		'search_items'       => __ ( 'Search Books' , 'your-plugin-textdomain' ) ,
		'parent_item_colon'  => __ ( 'Parent Books:' , 'your-plugin-textdomain' ) ,
		'not_found'          => __ ( 'No books found.' , 'your-plugin-textdomain' ) ,
		'not_found_in_trash' => __ ( 'No books found in Trash.' , 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels ,
		'public'             => TRUE ,
		'publicly_queryable' => TRUE ,
		'show_ui'            => TRUE ,
		'show_in_menu'       => TRUE ,
		'query_var'          => TRUE ,
		'rewrite'            => array( 'slug' => 'book' ) ,
		'capability_type'    => 'post' ,
		'has_archive'        => TRUE ,
		'hierarchical'       => FALSE ,
		'taxonomies'         => array(
			'category' ,
			'post_tag'
		) ,
		'menu_position'      => NULL ,
		'supports'           => array(
			'title' ,
			'editor' ,
			'author' ,
			'thumbnail' ,
			'excerpt' ,
			'comments'
		)
	);

	register_post_type ( 'book' , $args );
}*/
