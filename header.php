<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package prh-wp-theme
 */
?>

<!doctype html>
<html class="no-js" lang="" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php wp_head(); ?>
	</head>

	<body <?php body_class();?>>

		<?php get_template_part('svg') ?>

		<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<div class="page-container">
			<header role="banner" class="site-header" id="site-header">
			<div class="site-nav-wrap">
				<a href="/" class="logo col-sm-3 col-md-3">
					<span class="visually-hidden">PRH Homepage</span>
				</a>

				<div class="nav-ui">
					<button class="nav-btn search-btn">
						<svg class="icon--search" role="presentation">
							<use xlink:href="#icon--search" />
						</svg>
						<span class="visually-hidden">Search</span>
					</button>

					<a href="" class="nav-btn login-btn"> 
						<svg class="icon--person" role="presentation">
							<use xlink:href="#icon--person" />
						</svg>
						<span class="visually-hidden">Log In</span>
					</a>

					<button class="nav-btn menu-btn md-down" id="menu-btn" aria-controls="site-nav" aria-expanded="false">
						<svg class="icon--menu" role="presentation">
							<use xlink:href="#icon--menu" />
						</svg>
						<span class="visually-hidden">Menu</sspan>
					</button>

					<a href="#" class="nav-btn donate-btn cta cta--red md-up">Donate</a>
				</div>
				<nav id="site-nav" class="site-nav">
					<?php wp_nav_menu(); ?>
					<a href="#" class="nav-btn donate-btn cta cta--red md-down">Donate</a>
				</nav>
				</div>
			</header>
			<!-- <header role="banner" class="site-header" id="site-header">
				<nav role="navigation" class="site-nav row middle-xs">
						<a href="/" class="col-sm-3 col-md-3">
							<img class="logo" alt="" src="<?php //echo_theme_uri(); ?>/images/optimized/prh_nav_logo.svg" />
						</a>
						<?php// wp_nav_menu(); ?>
						<div class="col-xs-12 col-sm-1 col-md-2" style="text-align: right;">Donate</div>
					<?php //get_search_form(); ?>
				</nav>

			</header>
			<div class="nav-mask" id="nav-mask"></div> -->
