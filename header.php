<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title>
        <?php wp_title(); ?>
    </title>

    <!-- dns prefetch -->
    <link href="//www.google-analytics.com" rel="dns-prefetch">

    <!-- meta -->
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

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




    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h6>Contact</h6>
                </div>
                <div class="contact">
                    <div class="row">
                        <div class="col-md-6">
                            <p>183A Moulsham Street. Chelmsford. Essex. CM2 0LG</p>
                        </div>
                        <div class="contact1">
                            <div class="col-md-6">
                                <p>MOB: 07989 633363. TEL: 01245 283289. Ask for Emma James</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <small>&copy; 2016, Beauty by Emma.</small>
                        <small>Website Design by <a href="#">Hall &amp; Co.</a></small>
                    </div>
                </div>
            </div>
        </div>
    </footer>