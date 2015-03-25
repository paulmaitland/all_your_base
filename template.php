<?php /* Template Name: Demo Page Template */ get_header(); ?>
	
	
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		    <h1><?php the_title(); ?></h1>
		
			<?php the_content(); ?>
			
			<?php comments_template( '', true ); // Remove if you don't want comments ?>

			<br class="clear">

			<?php edit_post_link(); ?>
			
		</article>
		
	<?php endwhile; ?>
	
	<?php else: ?>

		<article>
			
			<h2><?php _e( 'Sorry, nothing to display.'); ?></h2>
			
		</article>
	
	<?php endif; ?>
	
	
<?php get_sidebar(); ?>

<?php get_footer(); ?>