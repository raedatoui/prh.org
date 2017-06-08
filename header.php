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

		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-PDFCFTR');</script>
		<!-- End Google Tag Manager -->
	</head>

	<body <?php body_class();?>>

		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PDFCFTR"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		<?php get_template_part('svg') ?>

		<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

		<div class="page-container">
			<header role="banner" class="site-header" id="site-header">
			<div class="site-nav-wrap">
				<a href="/" class="logo col-sm-3 col-md-3">
						<svg class="logo-svg logo-large md-up" role="presentation">
							<use xlink:href="#logo-large" />
						</svg>
						<svg class="logo-svg logo-small md-down" role="presentation">
							<use xlink:href="#logo-small" />
						</svg>
					<span class="visually-hidden">PRH Homepage</span>
				</a>

				<div class="nav-ui">
					<button class="nav-btn search-btn" id="site-search-btn" title="Search">
						<svg class="icon--search" role="presentation">
							<use xlink:href="#icon--search" />
						</svg>
					</button>

					<a href="/wp-admin/profile.php" class="nav-btn login-btn" title="Log in">
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
