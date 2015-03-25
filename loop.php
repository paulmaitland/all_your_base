<?php if (have_posts()): while (have_posts()): the_post(); ?>

    <article id="<?php the_ID();?>" <?php post_class();?>>
    
        <?php if (has_post_thumbnail()): ?>
            <a href="<?php the_permalink();?>" title="<?php the_title();?>">
                <?php the_post_thumbnail('thumbnail');?>
            </a>
        <?php endif; ?>
        
        <h2>
            <a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
        </h2>
        <ul class="post-details">
            <li><?php _e('Posted: ') || the_time('F j, Y');?></li>
            <li><?php _e('By: ') || the_author_posts_link();?></li>
            <li><?php comments_popup_link( __( 'Leave a comment'), __( '1 Comment'), __( '% Comments')); ?></li>
            <li><?php the_tags(__( 'Tags: '), ', ');?></li>
        </ul>
        
        <?php the_excerpt();?>
        
        <?php edit_post_link();?>
    
    </article>
    
<?php endwhile; ?>

<?php else: ?>

    <article>
        
        <h2>Sorry!</h2>
        
        <p>Nothing to display</p>
        
    </article>
    
<?php endif; ?>