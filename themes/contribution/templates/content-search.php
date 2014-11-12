<section id="primary" class="site-content">
	<div id="content" role="main">

		<?php if ( have_posts () ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf ( __ ( 'Search Results for: %s' , 'webberty' ) , '<span>' . get_search_query () . '</span>' ); ?></h1>
			</header>


			<?php /* Start the Loop */ ?>
			<?php while ( have_posts () ) : the_post (); ?>
				<p>
					<?php the_title () ?>
				</p>
			<?php endwhile; ?>


		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e ( 'Nothing Found' , 'webberty' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e ( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.' , 'webberty' ); ?></p>
					<?php get_search_form (); ?>
				</div>
				<!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

	</div>
	<!-- #content -->
</section><!-- #primary -->