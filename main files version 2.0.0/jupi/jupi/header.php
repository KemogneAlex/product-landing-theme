<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target=".mainmenu-area" data-offset="100">
	<?php wp_body_open(); ?>
    <?php get_template_part('template-parts/preloader'); ?>   
    <?php get_template_part('template-parts/nav-menu'); ?>  