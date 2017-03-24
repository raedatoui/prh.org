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
    <title>
			<?php
				wp_title( '|', true, 'right' );
				bloginfo( 'name' ); // Add the blog name.
				$site_description = get_bloginfo( 'description', 'display' ); // Add the blog description for the home/front page.
				if ( $site_description && ( is_home() || is_front_page() ) )
					echo " | $site_description";
			?>
		</title>
    <meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/main.css">
		<?php wp_head(); ?>
  </head>

	<body <?php body_class(); ?>>

		<div id="test"></div>

		<div id="page-container">

      <header>
				<nav>
					<ul id="main-nav-list" class="row bottom-xs">
						<li class="col-xs-12 col-sm-3 col-md-3 col-lg-3 logo-item"><img class="logo" alt="" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/optimized/prh_nav_logo.svg" /></li>
						<li class="col-xs-12 col-sm-8 col-md-7 col-lg-7">
							<ul class="secondary-nav-list row">
								<li class="col-xs-12 col-sm-3 col-md-3 col-lg-3">About</li>
								<li class="col-xs-12 col-sm-3 col-md-3 col-lg-3">Our Advocacy</li>
								<li class="col-xs-12 col-sm-3 col-md-3 col-lg-3">Resources</li>
								<li class="col-xs-12 col-sm-3 col-md-3 col-lg-3">Take Action</li>
							</ul>
						</li>
						<li class="col-xs-12 col-sm-1 col-md-2 col-lg-2" style="text-align: right;">Donate</li>
					</ul>
				</nav>
      </header>






			<section id="hero">
				<div class="row">
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">a</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">b</div>
					<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">c</div>
				</div>
			</section>

		</div><!-- end page-container -->
