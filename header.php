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
			<header>
				<nav>
					<ul class="main-nav-list row bottom-xs">
						<li class="col-xs-12 col-sm-3 col-md-3 logo-item">
							<a href="/"><img class="logo" alt="" src="<?php echo_theme_uri(); ?>/images/optimized/prh_nav_logo.svg" /></a>
						</li>
						<li class="col-xs-12 col-sm-8 col-md-7">
							<ul class="secondary-nav-list row">
								<?php
									$menu_items = wp_get_nav_menu_items("main-menu");
									foreach ( (array) $menu_items as $key => $menu_item ) {
										$title = $menu_item->title;
										$url = $menu_item->url;
										_e('<li class="col-xs-12 col-sm-3"><a href="' . $url . '">' . $title . '</a></li>');
									}
								?>
							</ul>
						</li>
						<li class="col-xs-12 col-sm-1 col-md-2" style="text-align: right;">Donate</li>
					</ul>
					<?php //get_search_form(); ?>
				</nav>

			</header>
