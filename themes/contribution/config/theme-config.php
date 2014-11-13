<?php
global $wp_version;


/*
| ----------------------------------------------------------------------------------------------------------------------
| SET THEME SUPPORT SETTINGS
| ----------------------------------------------------------------------------------------------------------------------
| Codex: http://codex.wordpress.org/Function_Reference/add_theme_support
| Description :
| Allows a theme or plugin to register support of a certain theme feature.
| If called from a theme, it should be done in the theme's functions.php file to work.
| It can also be called from a plugin if attached to an action hook.
| If attached to an action hook, it should be after_setup_theme.
| The init action hook may be too late for some features.
| Usage: <?php add_theme_support( $feature, $arguments ); ?>
|
*/

/*
| ----------------------------------------------------------------------------------------------------------------------
| Codex: http://codex.wordpress.org/Function_Reference/add_theme_support
| ----------------------------------------------------------------------------------------------------------------------
|
| This feature enables Post Thumbnails support for a Theme.
| The feature became available with Version 2.9.
| Note that you can optionally pass a second argument with an array of the Post Types for which you want to enable this feature.
| add_theme_support( 'post-thumbnails' );
| add_theme_support( 'post-thumbnails', array( 'post' ) );          // Posts only
| add_theme_support( 'post-thumbnails', array( 'page' ) );          // Pages only
| add_theme_support( 'post-thumbnails', array( 'post', 'movie' ) ); // Posts and Movies
| This feature must be called before the init hook is fired.
| That means it needs to be placed directly into functions.php or within a function attached to the 'after_setup_theme' hook.
| For custom post types, you can also add post thumbnails using the register_post_type function as well.
| To display thumbnails in themes index.php or single.php or custom templates,
| use:
| the_post_thumbnail();
| To check if there is a post thumbnail assigned to the post before displaying it, use:
|
| if ( has_post_thumbnail() )
| {
| 	the_post_thumbnail();
| }
|
*/
add_theme_support ( 'post-thumbnails' );

/*
| ----------------------------------------------------------------------------------------------------------------------
| Codex: http://codex.wordpress.org/Function_Reference/add_theme_support#Feed_Links
| ----------------------------------------------------------------------------------------------------------------------
| This feature enables post and comment RSS feed links to head.
| This should be used in place of the deprecated automatic_feed_links() function.
| This feature became available with Version 3.0.
|
| add_theme_support( 'automatic-feed-links' );
*/
add_theme_support ( 'automatic-feed-links' );

/*
| ----------------------------------------------------------------------------------------------------------------------
| Codex:http://codex.wordpress.org/Post_Formats
| ----------------------------------------------------------------------------------------------------------------------
| Post Formats:
| This feature enables Post Formats support for a Theme.
| This feature became available with Version 3.1.
| When using Child Themes, be aware that add_theme_support( 'post-formats' ) will override the formats as defined by the parent theme, not add to it.
| To enable the specific formats (see supported formats at Post Formats : http://codex.wordpress.org/Post_Formats),
| use:
| add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );
| To check if there is a 'quote' post format assigned to the post, use
|
| // in your theme single.php, page.php or custom post type
| if ( has_post_format( 'quote' ) ) {
|	echo 'This is a quote.';
| }
*/
add_theme_support ( 'post-formats' , array(
	//Typically styled without a title. Similar to a Facebook note update.
	'aside' ,
	//A gallery of images. Post will likely contain a gallery shortcode and will have image attachments.
	'gallery' ,
	//A link to another site. Themes may wish to use the first <a href=””> tag in the post content as the external link for that post.
	//An alternative approach could be if the post consists only of a URL, then that will be the URL and the title (post_title) will be the name attached to the anchor for it.
	'link' ,
	// A single image. The first <img /> tag in the post could be considered the image.
	//Alternatively, if the post consists only of a URL, that will be the image URL and the title of the post (post_title) will be the title attribute for the image.
	'image' ,
	//quote - A quotation.
	//Probably will contain a blockquote holding the quote content.
	//Alternatively, the quote may be just the content, with the source/author being the title.
	'quote' ,
	// A short status update, similar to a Twitter status update.
	'status' ,
	//A single video. The first <video /> tag or object/embed in the post content could be considered the video.
	//Alternatively, if the post consists only of a URL, that will be the video URL.
	//May also contain the video as an attachment to the post, if video support is enabled on the blog (like via a plugin).
	'video' ,
	//An audio file. Could be used for Podcasting.
	'audio' ,
	// A chat transcript, like so:
	'chat'
) );

/*
| ----------------------------------------------------------------------------------------------------------------------
| Codex:http://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Background
| ----------------------------------------------------------------------------------------------------------------------
| This feature enables Custom_Backgrounds support for a theme as of Version 3.4.
|
| add_theme_support( 'custom-background' );
| Note that you can add default arguments using:
|
| $defaults = array(
| 	'default-color'          => '',
| 	'default-image'          => '',
| 	'wp-head-callback'       => '_custom_background_cb',
| 	'admin-head-callback'    => '',
| 	'admin-preview-callback' => ''
| );
| add_theme_support( 'custom-background', $defaults );
| To make this backwards compatible you can use this check to determine if WordPress is at least version 3.4 or not.
|  So during the transition to 3.4, you can support both functions by using them in the alternative:
| global $wp_version;
| if ( version_compare( $wp_version, '3.4', '>=' ) ) {
| 	add_theme_support( 'custom-background' );
| } else {
| 	add_custom_background( $args );
| }
*/
$defaults = array(
	'default-color'          => '' ,
	'default-image'          => '' ,
	'wp-head-callback'       => '_custom_background_cb' ,
	'admin-head-callback'    => '' ,
	'admin-preview-callback' => ''
);
if ( version_compare ( $wp_version , '3.4' , '>=' ) )
{
	add_theme_support ( 'custom-background' );
}
else
{
	add_custom_background ( $args );
}

/*
| ----------------------------------------------------------------------------------------------------------------------
| Codex:http://codex.wordpress.org/Function_Reference/add_theme_support#Custom_Header
| ----------------------------------------------------------------------------------------------------------------------
| This feature enables Custom_Headers support for a theme as of Version 3.4.
|
| add_theme_support( 'custom-header' );
| Note that you can add default arguments using:
|
| $defaults = array(
| 	'default-image'          => '',
| 	'random-default'         => false,
| 	'width'                  => 0,
| 	'height'                 => 0,
| 	'flex-height'            => false,
| 	'flex-width'             => false,
| 	'default-text-color'     => '',
| 	'header-text'            => true,
| 	'uploads'                => true,
| 	'wp-head-callback'       => '',
| 	'admin-head-callback'    => '',
| 	'admin-preview-callback' => '',
| );
| add_theme_support( 'custom-header', $defaults );
| To make this backwards compatible you can use this check to determine if WordPress is at least version 3.4 or not.
| So during the transition to 3.4, you can support both functions by using them in the alternative:
| global $wp_version;
| if ( version_compare( $wp_version, '3.4', '>=' ) ) {
| 	add_theme_support( 'custom-header' );
| } else {
| 	add_custom_image_header( $wp_head_callback, $admin_head_callback, $admin_preview_callback );
| }
*/

/*
if ( version_compare ( $wp_version , '3.4' , '>=' ) )
{
	add_theme_support ( 'custom-header' );
}
*/

/*
| ----------------------------------------------------------------------------------------------------------------------
| Codex: http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
| ----------------------------------------------------------------------------------------------------------------------
| This feature allows the use of HTML5 markup for the comment forms, search forms and comment lists.
|
| add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
*/
add_theme_support ( 'html5' , array(
	'comment-list' ,
	'comment-form' ,
	'search-form' ,
	'gallery' ,
	'caption'
) );

/*
| ----------------------------------------------------------------------------------------------------------------------
| Set default upload folder
| ----------------------------------------------------------------------------------------------------------------------
| Set default upload forler
*/
if ( get_option ( 'upload_path' ) == 'wp-content/uploads' || get_option ( 'upload_path' ) == NULL )
{
	update_option ( 'upload_path' , 'assets' );
}

/*
| ----------------------------------------------------------------------------------------------------------------------
| Add extra meta data
| ----------------------------------------------------------------------------------------------------------------------
| Add extra meta data in the heade.php side when <?php wp_head (); ?> is used
| This functionality is placed in system/WBB_Core/WBB-Core.php function name  AddMetaTags ().
*/
$autoload[ 'meta_tags' ] = array(
	'<meta charset="utf-8">' ,
	'<meta name="viewport" content="width=device-width, initial-scale=1">' ,
	'<link rel="shortcut icon" href="../../assets/ico/favicon.ico">' ,
);
if (isset($_SERVER['HTTP_USER_AGENT']) &&
        (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false))
    header('X-UA-Compatible: IE=edge,chrome=1');
/*
| ----------------------------------------------------------------------------------------------------------------------
| Codex: http://codex.wordpress.org/Function_Reference/register_sidebars
| ----------------------------------------------------------------------------------------------------------------------
| Register Multiple Side bars
| Creates multiple Sidebars.
|
| Registers one or more sidebars to be used in the current theme. Most themes have only one sidebar.
| For this reason, the number parameter is optional and defaults to one.
|
| The args array parameter can contain a 'name' which will be prepended to the sidebar number if there is more than one sidebar.
| If no name is specified, 'Sidebar' is used.
|
| Usage :
|
| <?php register_sidebars( $number, $args ); ?>
|
| Default Usage
| <?php $args = array(
| 	'name'          => sprintf(__('Sidebar %d'), $i ),
| 	'id'            => "sidebar-$i",
| 	'description'   => '',
| 	'class'         => '',
| 	'before_widget' => '<li id="%1$s" class="widget %2$s">',
| 	'after_widget'  => '</li>',
| 	'before_title'  => '<h2 class="widgettitle">',
| 	'after_title'   => '</h2>' ); ?>
| Parameters
| number
| (integer) (optional) Number of sidebars to create.
| Default: 1
| args
| (string/array) (optional) Builds Sidebar based off of 'name' and 'id' values.
| Default: None
| name - Sidebar name. (Note: If copying from default usage above, remove sprintf( ) wrapper function.)
| id - Sidebar id. (Note: "-$i" is added automatically to supplied 'id' value after the first; e.g., "Sidebar", "Sidebar-2", "Sidebar-3", etc.)
| description - Text description of what/where the sidebar is. Shown on widget management screen. (Since 2.9) (default: empty)
| class - CSS class name to assign to the widget HTML (default: empty).
| before_widget - HTML to place before every widget.
| after_widget - HTML to place after every widget.
| before_title - HTML to place before every title.
| after_title - HTML to place after every title.
| The optional args parameter is an associative array that will be passed as a first argument to every active widget callback.
| (If a string is passed instead of an array, it will be passed through parse_str() to generate an associative array.)
| The basic use for these arguments is to pass theme-specific HTML tags to wrap the widget and its title.
*/
register_sidebars ( 3 , array( 'name' => 'Side Bar % d' ) );

/*
| ----------------------------------------------------------------------------------------------------------------------
| Codex: http://codex.wordpress.org/Function_Reference/register_sidebar
| ----------------------------------------------------------------------------------------------------------------------
| Register Single Side Bar
| Description
| Builds the definition for a single sidebar and returns the ID. Call on "widgets_init" action.
|
| Usage
|
| <?php register_sidebar( $args ); ?>

| Default Usage:
| <?php $args = array(
| 	'name'          => __( 'Sidebar name', 'theme_text_domain' ),
| 	'id'            => 'unique-sidebar-id',
| 	'description'   => '',
|       'class'         => '',
| 	'before_widget' => '<li id="%1$s" class="widget %2$s">',
| 	'after_widget'  => '</li>',
| 	'before_title'  => '<h2 class="widgettitle">',
| 	'after_title'   => '</h2>' ); ?>
| Parameters:
| args:
| (string/array) (optional) Builds Sidebar based off of 'name' and 'id' values.
| Default: None
| name - Sidebar name (default is localized 'Sidebar' and numeric ID).
| id - Sidebar id - Must be all in lowercase, with no spaces (default is a numeric auto-incremented ID).
| description - Text description of what/where the sidebar is. Shown on widget management screen. (Since 2.9) (default: empty)
| class - CSS class name to assign to the widget HTML (default: empty).
| before_widget - HTML to place before every widget(default: '<li id="%1$s" class="widget %2$s">') Note: uses sprintf for variable substitution
| after_widget - HTML to place after every widget (default: "</li>\n").
| before_title - HTML to place before every title (default: <h2 class="widgettitle">).
| after_title - HTML to place after every title (default: "</h2>\n").
| The optional args parameter is an associative array that will be passed as a first argument to every active widget callback.
| (If a string is passed instead of an array, it will be passed through parse_str() to generate an associative array.)
| The basic use for these arguments is to pass theme-specific HTML tags to wrap the widget and its title.
|
| Notes:
| With WordPress 3.4.1 there're still some IDs to avoid, that can be found here. Props to "toscho" for building a plugin collecting and listing them.
| Calling register_sidebar() multiple times to register a number of sidebars is preferable to using register_sidebars() to create a bunch in one go,
| because it allows you to assign a unique name to each sidebar (eg: “Right Sidebar”, “Left Sidebar”).
| Although these names only appear in the admin interface it is a best practice to name each sidebar specifically,
|  giving the administrative user some idea as to the context for which each sidebar will be used.
| The default before/after values are intended for themes that generate a sidebar marked up as a list with h2 titles.
| This is the convention we recommend for all themes and any theme built in this way can simply register sidebars without worrying about the before/after tags.
| If, for some compelling reason, a theme cannot be marked up in this way, these tags must be specified when registering sidebars.
| It is recommended to copy the id and class attributes verbatim so that an internal sprintf call can work and CSS styles can be applied to individual widgets.
| Example
| This will create a sidebar named "RightSideBar" with <h1> and </h1> before and after the title:
|
| register_sidebar( array(
|     'name'         => __( 'Right Hand Sidebar' ),
|     'id'           => 'sidebar-1',
|    'description'  => __( 'Widgets in this area will be shown on the right-hand side.' ),
|     'before_title' => '<h1>',
|     'after_title'  => '</h1>',
| ) );
*/
register_sidebar ( array(
	'name'         => __ ( 'Right Hand Sidebar' ) ,
	'id'           => 'right - sidebar' ,
	'description'  => __ ( 'Widgets in this area will be shown on the right - hand side . ' ) ,
	'before_title' => ' < h1>' ,
	'after_title'  => ' </h1 > '
) );

/*
| ----------------------------------------------------------------------------------------------------------------------
| Codex: http://codex.wordpress.org/Function_Reference/register_nav_menus
| ----------------------------------------------------------------------------------------------------------------------
| Function Reference/register nav menus
| Description
| Registers multiple custom navigation menus in the new custom menu editor of WordPress 3.0.
| This allows for the creation of custom menus in the dashboard for use in your theme.
|
| See register_nav_menu() for creating a single menu, and Navigation Menus for adding theme support.
|
| Usage
|
| <?php register_nav_menus( $locations ); ?>
|
| Parameters
| $locations
| (array) (required) An associative array of menu location slugs (key) and descriptions (according value).
| Default: None
| Return Values
| None.
|
| Examples
| register_nav_menus( array(
| 	'pluginbuddy_mobile' => 'PluginBuddy Mobile Navigation Menu',
| 	'footer_menu' => 'My Custom Footer Menu'
| ) );
| Notes
| This function automatically registers custom menu support for the theme therefore you do not need to call add_theme_support( 'menus' );
| Use wp_nav_menu() to display your custom menu.
| In the Menus admin page, there is a Show advanced menu properties to allow "Link Target" "CSS Classes" "Link Relationship (XFN) Description"
| Use get_registered_nav_menus to get back a list of the menus that have been registered in a theme.
*/
/*register_nav_menus ( array (
					 'Website Top Navigation Menu' ,
					 'Website Footer Menu'
				 ) );*/

register_nav_menu ( 'primary_navigation' , __ ( 'Website Top Navigation Menu' ) );
register_nav_menu ( 'primary_footer_navigation' , __ ( 'Website Footer Menu' ) );

$menuname                  = 'Top Menu';
$primary_navigation        = 'primary_navigation';
$primary_footer_navigation = 'primary_footer_navigation';

// Does the menu exist already?
$menu_exists = wp_get_nav_menu_object ( $menuname );

// If it doesn't exist, let's create it.
if ( ! $menu_exists )
{
	$menu_id = wp_create_nav_menu ( $menuname );


	// Set up default BuddyPress links and add them to the menu.
	wp_update_nav_menu_item ( $menu_id , 0 , array(
		'menu-item-title'   => __ ( 'Home' ) ,
		'menu-item-classes' => 'home' ,
		'menu-item-url'     => home_url ( '/' ) ,
		'menu-item-status'  => 'publish'
	) );

	//Grab the theme locations and assign our newly - created menu
	if ( ! has_nav_menu ( $primary_navigation ) )
	{
		$locations                        = get_theme_mod ( 'nav_menu_locations' );
		$locations[ $primary_navigation ] = $menu_id;
		set_theme_mod ( 'nav_menu_locations' , $locations );
	}

	if ( ! has_nav_menu ( $primary_footer_navigation ) )
	{
		$locations                               = get_theme_mod ( 'nav_menu_locations' );
		$locations[ $primary_footer_navigation ] = $menu_id;
		set_theme_mod ( 'nav_menu_locations' , $locations );
	}

}

/*
| ----------------------------------------------------------------------------------------------------------------------
| Head Clean up
| ----------------------------------------------------------------------------------------------------------------------
| Remove unnecessary meta data from head
| Head Originally from http://wpengineer.com/1438/wordpress-header/
| Head Cleanup function placed in system/WBB_Core/WBB-Core.php , function headCleanup ()
*/
$autoload[ 'head_cleanup' ] = array(
	'wp_generator' ,
	'feed_links' ,
	'feed_links_extra' ,
	'rsd_link' ,
	'wlwmanifest_link' ,
	'adjacent_posts_rel_link_wp_head' ,
	'wp_shortlink_wp_head' ,
);
