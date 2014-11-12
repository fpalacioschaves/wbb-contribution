<?php while ( have_posts () ) :
	the_post (); ?>
	<article <?php post_class (); ?>>
		<header>
			<h1 class="entry-title"><?php the_title (); ?></h1>
			<!---Add Your Entry meta here/--->
		</header>
		<div class="entry-content">
			<?php the_content (); ?>
		</div>
		<footer>
			<?php wp_link_pages ( array(
				'before' => '<nav class="page-nav"><p>' . __ ( 'Pages:' , 'webberty' ) ,
				'after'  => '</p></nav>'
			) ); ?>
			<?php the_tags ( '<ul class="entry-tags"><li>' , '</li><li>' , '</li></ul>' ); ?>
		</footer>
		<!--You can add your comments template component here/--->
	</article>
<?php endwhile; ?>
