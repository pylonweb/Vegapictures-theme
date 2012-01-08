<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />
		<?php
		function my_scripts_method() {
		    wp_register_script( 'mainJS', get_bloginfo('template_directory') . '/application.js', array('jquery'));
		    wp_enqueue_script( 'mainJS' );
		    
				wp_register_script( 'videoJS', get_bloginfo('template_directory') . '/video.js', array('jquery'));
				wp_enqueue_script( 'videoJS' );
				if (is_front_page()) :
					wp_register_script( 'video_gallery', get_bloginfo('template_directory') . '/video_gallery.js', array('jquery'));
					wp_enqueue_script( 'video_gallery' );
				endif;
		}    

		add_action('wp_enqueue_scripts', 'my_scripts_method');
		?>
		<?php wp_head(); ?>

</head>

<body id="index" class="home">
	<div id="container">
		<a href="index.html"><img id="logoimg" src="<?php bloginfo('template_directory'); ?>/images/VEGAlogo_top_picwhite_XXL.jpg" border="0" alt="logo" width="815" height="429"></a>

	    <div class="menu_wrapper">

		<?php wp_nav_menu(); ?>

		<p class="intro">VEGA PICTURES / tv / film / doc / web / corporate</p>

		</div>