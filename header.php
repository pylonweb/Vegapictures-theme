<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title(); ?> <?php bloginfo( 'name' ); ?></title>
		<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" type="text/css" media="screen" />

		<style type="text/css">
		<?php
		global $q_config;
		if(isset($q_config) && $q_config['language'] == "en"){ ?>
			.page_item {
				font-size: 40px !important;
				margin-right: 32px !important;
			}
		<?php } else { ?>
			.page_item {
				font-size: 38px !important;
				margin-right: 28px !important;
			}
		<?php }; ?>
		</style>
		
		<?php
		function my_scripts_method() {
		    wp_register_script( 'mainJS', get_bloginfo('template_directory') . '/application.js', array('jquery'));
		    wp_enqueue_script( 'mainJS' );
		    
				
				//if (is_front_page()) :
				wp_register_script( 'videoJS', get_bloginfo('template_directory') . '/video.js', array('jquery'));
				wp_enqueue_script( 'videoJS' );
					wp_register_script( 'video_gallery', get_bloginfo('template_directory') . '/video_gallery.js', array('jquery'));
					wp_enqueue_script( 'video_gallery' );
				//endif;
		}    

		add_action('wp_enqueue_scripts', 'my_scripts_method');
		?>
		<?php wp_head(); ?>

</head>

<body id="index" class="home">
	<div id="container">
		<div id="header">
			<a id="logo_anchor" href="<?php echo get_option('home'); global $q_config; if(isset($q_config) && $q_config['default_language'] != $q_config['language']){echo "/" . $q_config['language'];} ?>"><img id="logoimg" src="<?php bloginfo('template_directory'); ?>/images/VEGAlogo_top_picwhite.gif" border="0" alt="logo"></a>
			<img id="unitedimg" src="<?php bloginfo('template_directory'); ?>/images/part_of_UNITED.png" border="0" alt="Part of UNITED">
		</div>
	    <div class="menu_wrapper">

		<?php wp_nav_menu(); ?>
		<p class="intro">VEGA PICTURES / tv / film / doc / web / corporate
			<?php
			global $q_config;
			if(isset($q_config)){
			if(is_404()) $url = get_option('home'); else $url = '';
				foreach(qtrans_getSortedLanguages() as $language) {
					if($language != $q_config['language']){
						echo '<a href="'.qtrans_convertURL($url, $language).'"';
						echo ' class="qtrans_flag_'.$language.' qtrans_flag_and_text" title="'.$q_config['language_name'][$language].'"';
						echo '></a>';
						//echo '><span>'.$q_config['language_name'][$language].'</span></a>';
					}
				}
			}
			?>
		</p>
		</div>