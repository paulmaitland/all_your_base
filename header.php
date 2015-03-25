<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(); ?></title>
		
		<!-- dns prefetch -->
		<link href="//www.google-analytics.com" rel="dns-prefetch">
        
        <!-- meta -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
    
        <!-- icons -->
		<link href="<?php echo get_template_directory_uri(); ?>/images/icons/favicon.ico" rel="shortcut icon">
		<link href="<?php echo get_template_directory_uri(); ?>/images/icons/touch.png" rel="apple-touch-icon-precomposed">
    
        <!-- css + javascript -->
        <?php wp_head(); ?>
        <!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
		<![endif]-->
    
    </head>
    <body <?php body_class();?>>
    
    <header role="banner">
        <h1><a href="<?php echo home_url();?>"><?php bloginfo('name');?></a></h1>
        <h2><?php bloginfo('description');?></h2>
    </header>
    
    <nav role="navigation">
        <?php wp_nav_menu();?>
    </nav>
