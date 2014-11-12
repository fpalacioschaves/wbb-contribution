<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?> >
<head>

	<?php wp_head (); ?>

	<title><?php wp_title ( '|' , true , 'right' );?></title>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->

	<?php if ( wp_count_posts ()->publish > 0 ) : ?>
		<link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo ( 'name' ); ?> Feed"  href="<?php echo home_url (); ?>/feed/">
	<?php endif; ?>

	<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>

</head>
