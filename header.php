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
						<svg class="logo-svg logo-large role="presentation">
							<use xlink:href="#logo-large" />
						</svg>
						<svg class="logo-svg logo-small" role="presentation">
							<use xlink:href="#logo-small" />
						</svg>
					<span class="visually-hidden">Physicians for Reproductive Health: Homepage</span>
				</a>

				<div class="nav-ui">
					<button class="nav-btn search-btn" id="site-search-btn" title="Search">
						<svg class="icon--search" role="presentation">
							<use xlink:href="#icon--search" />
						</svg>
					</button>

					<a href="/wp-login.php" class="nav-btn login-btn" title="Log in"> 
						<svg class="icon--person" role="presentation">
							<use xlink:href="#icon--person" />
						</svg>
					</a>

					<button class="nav-btn menu-btn md-down" id="menu-btn" aria-controls="site-nav" aria-expanded="false" title="Menu">
						<svg class="icon--menu" role="presentation">
							<use xlink:href="#icon--menu" />
						</svg>
					</button>

					<a href="https://secure2.convio.net/prch/site/Donation2?idb=1471799783&DONATION_LEVEL_ID_SELECTED=1&df_id=1542&mfc_pref=T&1542.donation=form1&idb=0" class="nav-btn donate-btn cta cta--red md-up">Donate</a>
				</div>

				<nav id="site-nav" class="site-nav">
					<?php wp_nav_menu(array('theme_location' => 'menu-1')); ?>

					<a href="https://secure2.convio.net/prch/site/Donation2?idb=1471799783&DONATION_LEVEL_ID_SELECTED=1&df_id=1542&mfc_pref=T&1542.donation=form1&idb=0" class="nav-btn donate-btn cta cta--red md-down">Donate</a>
					
				</nav>
				</div>

				<div id="search-bar" class="search-bar">
					<div class="content search-bar-content">
					<?php get_search_form(); ?>
					</div>
				</div>

			</header>
			<div class="nav-mask" id="nav-mask"></div>
