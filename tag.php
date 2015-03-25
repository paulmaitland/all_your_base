<?php get_header();?>

<h1><?php _e( 'Posts tagged: '); echo single_tag_title('', false); ?></h1>
	
<?php get_template_part('loop'); ?>
		
<?php get_template_part('pagination'); ?>

<?php get_footer();?>