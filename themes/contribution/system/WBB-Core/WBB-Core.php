<?php
/**
 * Load The Page Content
 *
 * @return mixed
 */
function getPageContent ()
{

	global $post;

	if ( isset( $post->ID ) )
	{

		$form = get_post_meta ( get_the_ID () , '_wp_page_template' );
	}
	else
	{
		$form = array();
	}

	//Load Page Template
	if ( ! empty( $form[ 0 ] ) && $form[ 0 ] != 'default' )
	{
		$path_info = pathinfo ( $form[ 0 ] );
		$dirname   = $path_info[ 'dirname' ];
		$filename  = $path_info[ 'filename' ];

		return get_template_part ( $dirname . '/' . $filename );
	}
	else
	{

		if ( is_attachment () )
		{
			return get_template_part ( GET_ATTACHMENT_CONTENT );

		}
		else if ( is_single () )
		{
			return get_template_part ( GET_SINGLE_CONTENT );
		}
		elseif ( is_search () )
		{
			return get_template_part ( GET_SEARCH_CONTENT );
		}
		else if ( is_tax () )
		{
			return get_template_part ( GET_TAXONOMY_CONTENT );

		}
		else if ( is_tag () )
		{
			return get_template_part ( GET_TAG_CONTENT );

		}
		else if ( is_category () )
		{
			return get_template_part ( GET_CATEGORY_CONTENT );

		}
		else if ( is_archive () )
		{
			return get_template_part ( GET_ARCHIVE_CONTENT );


		}

		else if ( is_author () )
		{
			return get_template_part ( GET_AUTHOR_CONTENT );

		}
		elseif ( is_404 () )
		{
			//Check if 404.php file is added
			if ( is_file ( get_template_directory () . '/' . GET_404_CONTENT . '.php' ) )
			{

				return get_template_part ( GET_404_CONTENT );
			}
			else
			{
				return _e ( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.' , 'webberty' );
			}
		}
		elseif ( is_page ( $post->ID ) )
		{
			return get_template_part ( GET_PAGE_CONTENT );
		}
	}
}


/***************************************************************************************************************************************/
add_filter ( 'body_class' , 'titleInBodyClass' );

/**
 * This Function will add the page title to the body_class for easy styling of page files
 *
 * @param $classes
 *
 * @return mixed
 */
function titleInBodyClass ( $classes )
{


	$blog = array_search ( 'blog' , $classes );

	unset( $classes[ $blog ] );


	if ( is_singular () )
	{
		global $post;


		array_push ( $classes , "{$post->post_type}-{$post->post_name}" );
	}

	return $classes;
}

/***************************************************************************************************************************************/
/**
 * This Functionis take any variable from theme-config.php file
 *
 * @param      $autoload_variable
 * @param bool $echo
 *
 * @return mixed
 */
function get_config ( $autoload_variable , $echo = FALSE )
{

	global $autoload;
	if ( isset( $autoload[ $autoload_variable ] ) )
	{

		if ( $echo && ( ! is_array ( $autoload[ $autoload_variable ] ) ) )
		{
			echo $autoload[ $autoload_variable ];
		}
		else
		{
			return $autoload[ $autoload_variable ];
		}
	}
	else
	{
		wp_die ( "Config variable " . $autoload_variable . " not set in theme-config.php file" );
	}

}

/***************************************************************************************************************************************/
add_filter ( 'template_include' , 'filterCategoryTemplate' );

/**
 * filter Category Template
 */
function filterCategoryTemplate ()
{

	$templates = array( FILTER_CATEGORY_TEMPLATE );

	locate_template ( $templates , TRUE );

}

/**
 * Add custom Meta tags
 */
function AddMetaTags ()
{
	global $autoload;
	if ( isset( $autoload[ 'meta_tags' ] ) && ( ! empty( $autoload[ 'meta_tags' ] ) ) )
	{
		if ( is_array ( $autoload[ 'meta_tags' ] ) )
		{

			foreach ( $autoload[ 'meta_tags' ] as $meta )
			{
				echo $meta . "\n";
			}
		}
		else
		{
			echo $autoload[ 'meta_tags' ];
		}
	}
}

add_action ( 'wp_head' , 'AddMetaTags' , 1 );
/***************************************************************************************************************************************/

/**
 * Clean Head Originally from http://wpengineer.com/1438/wordpress-header/
 */
function HeadCleanup ()
{
	global $autoload;

	if ( isset( $autoload[ 'head_cleanup' ] ) && ( ! empty( $autoload[ 'head_cleanup' ] ) ) )
	{
		foreach ( $autoload[ 'head_cleanup' ] as $head_cleanup )
		{
			remove_action ( 'wp_head' , $head_cleanup );
		}
	}

}

add_action ( 'init' , 'HeadCleanup' );
/***************************************************************************************************************************************/
