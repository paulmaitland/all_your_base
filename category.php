<?php get_header();?>

<h1><?php single_cat_title(); ?></h1>

<?php echo category_description();?>

<?php get_template_part('loop');?>

<?php get_template_part('pagination');?>

<?php get_sidebar();?>

<?php get_footer();?>