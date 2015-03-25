<?php get_header(); ?>

<?php if (have_posts()): while (have_posts()) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
        <h1><?php the_title(); ?></h1>
    
        <?php the_content(); ?>
    
        <br class="clear">
    
        <?php edit_post_link(); ?>
    
    </article>

<?php endwhile; ?>

<?php else: ?>

    <article>
    
        <h2>Sorry!</h2>
        <p>Nothing to display!</p>
    
    </article>

<?php endif; ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>