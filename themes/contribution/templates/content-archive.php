<!-- WordPress Loop -->
<?php if ( have_posts () ) : ?>

	<div id="title2">

		<?php $post = $posts[ 0 ]; // Hack. Set $post so that the_date() works. ?>

		<?php /* If this is a category archive */
		if ( is_category () )
		{
			?>

			<h3 class="pagetitle">Entries in <?php single_cat_title (); ?> Category</h3>

			<?php /* If this is a tag archive */
		}
		elseif ( is_post_type_archive () )
		{
			?>
			
			<h3 class="title page-title"><?php post_type_archive_title() ?></h3>
			
			<?php /* If this is a post-type archive */
		}
		elseif ( is_tag () )
		{
			?>

			<h3 class="pagetitle">Posts Tagged &#8216;<?php single_tag_title (); ?>&#8217;</h3>

			<?php /* If this is a daily archive */
		}
		elseif ( is_day () )
		{
			?>

			<h3 class="pagetitle">Archive for <?php the_time ( 'F jS, Y' ); ?></h3>

			<?php /* If this is a monthly archive */
		}
		elseif ( is_month () )
		{
			?>
			;

			<h3 class="pagetitle">Archive for <?php the_time ( 'F, Y' ); ?></h3>

			<?php /* If this is a yearly archive */
		}
		elseif ( is_year () )
		{
			?>

			<h3 class="pagetitle">Archive for <?php the_time ( 'Y' ); ?></h3>

			<?php /* If this is an author archive */
		}
		elseif ( is_author () )
		{
			?>

			<h3 class="pagetitle">Author Archive</h3>

			<?php /* If this is a paged archive */
		}
		elseif ( isset( $_GET[ 'paged' ] ) && ! empty( $_GET[ 'paged' ] ) )
		{
			?>

			<h3 class="pagetitle">Blog Archives</h3>

		<?php } ?>

	</div>

	<ul>
		<?php while ( have_posts () ) : the_post (); ?>

			<li><a href="<?php the_permalink () ?>" rel="bookmark"
			       title="Permanent Link to <?php the_title_attribute (); ?>"><?php the_title (); ?></a>
				- <?php the_time ( 'F jS' ) ?>, <?php the_time ( 'Y' ) ?>
				(<?php comments_number ( __ ( 'No Comments' ) , __ ( '1 Comment' ) , __ ( '% Comments' ) ); ?>)
			</li>

		<?php endwhile; ?>

	</ul>

	<div id="paging">

		<?php $previous = get_bloginfo ( 'template_directory' ); ?>

		<ul class="navigationarrows">
			<li class="previous"><?php previous_posts_link ( '<img src="' . $previous . '/images/next.png" alt="Next" title="Next" />' ) ?></li>
			<li class="next"><?php next_posts_link ( '<img src="' . $previous . '/images/previous.png" alt="Previous" title="Previous" />' ) ?></li>
		</ul>

	</div>

<?php else : ?>
	<h6 class="center">Not Found</h6>
	<p class="center">Sorry, but you are looking for something that isn't here.</p>
<?php endif; ?>
</div>

<!-- End WordPress Loop -->
