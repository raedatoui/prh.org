<?php

// enforce a single columns for legibility
function prh_dashboard_columns() {
	add_screen_option(
		'layout_columns',
		array(
			'max'     => 1,
			'default' => 1
		)
	);
}
add_action( 'admin_head-index.php', 'prh_dashboard_columns' );

// remove and and add new dashboard widgets
function prh_custom_dashboard_widgets() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
	remove_meta_box('dashboard_quick_press','dashboard','side'); //Quick Press widget
	remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );

	if ( current_user_can('administrator') ) {
		wp_add_dashboard_widget( 'prh_content_type_guide', 'Content Type Guide', 'prh_content_type_guide_widget' );
		wp_add_dashboard_widget( 'prh_menus_guide', 'Menus Guide', 'prh_menus_guide_widget' );
		wp_add_dashboard_widget( 'prh_members_guide', 'Members Guide', 'prh_members_guide_widget' );
	}
	if ( is_member( 'LTA' ) ) {
		remove_meta_box('dashboard_activity', 'dashboard', 'normal');
		wp_add_dashboard_widget( 'prh_lta_members', 'LTA Members', 'prh_lta_members_widget' );
	}
	if ( is_member( 'PS' ) ) {
		remove_meta_box('dashboard_activity', 'dashboard', 'normal');
		wp_add_dashboard_widget( 'prh_ps_members', 'Physician Safety Members', 'prh_ps_members_widget' );
	}
}
add_action( 'wp_dashboard_setup', 'prh_custom_dashboard_widgets' );

function prh_content_type_guide_widget(){ ?>
	<style>
		table, th, td {
			border: 1px solid black;
		}
		tbody .header {
			font-weight: bold;
		}
	</style>
	<p>This content management system lets you edit the pages and posts on your website.
	Your site consists of the following content, which you can access via the menu on the left:</p>

	<table cellpadding="2" cellspacing="4">
		<tbody>
			<tr style="height:20px;" class="header">
				<td style="width: 100px;">Content type</td>
				<td>Definition/purpose</td>
				<td>Examples</td>
			</tr>
			<tr style="height:20px;">
				<td><a href="/wp-admin/edit.php?post_type=page">Page</a></td>
				<td>Main Issue and About Us pages.</td>
				<td>Abortion, Our Impact</td>
			</tr>
			<tr style="height:20px;">
				<td><a href="/wp-admin/edit.php?post_type=press_release">Press release</a></td>
				<td>Releasing official PRH organizational news (appointments, major events) &amp; statements on PRH’s position in response to recent events. * Appears in Newsroom</td>
				<td>Dr. Willie Parker announced as PRH’s new board chair Statement on the confirmation of Jeff Sessions as Attorney General</td>
			</tr>
			<tr style="height:20px;">
				<td><a href="/wp-admin/edit.php?post_type=prh_events">Event</a></td>
				<td>Communicating events that PRH is hosting or promoting with partners</td>
				<td>It’s Pink Out Day</td>
			</tr>
			<tr style="height:20px;">
				<td><a href="/wp-admin/edit.php?post_type=prh_updates">Update</a></td>
				<td>Communicating ongoing activities of PRH and its physicians, updates in the field, etc., akin to posting a blog.</td>
				<td>Leadership Training Academy class of 2017 in Washington D.C.</td>
			</tr>
			<tr style="height:20px;">
				<td><a href="/wp-admin/edit.php?post_type=prh_ipaper">Legal publication</a></td>
				<td>Publishing an amicus brief or testimony.</td>
				<td>Testimony of a physician in support of a piece of legislation Amicus Brief, Whole Woman's Health v. Cole</td>
			</tr>
			<tr style="height:20px;">
				<td><a href="/wp-admin/edit.php?post_type=prh_stories">Story</a></td>
				<td>Communicating personal stories from PRH’s physicians and patients (includes videos)</td>
				<td>Let Me Make This Promise: Comprehensive Healthcare Access For Young Latinas</td>
			</tr>
			<tr style="height:20px;">
				<td><a href="/wp-admin/edit.php?post_type=prh_reports">Report</a></td>
				<td>Publishing an academic report or publication.</td>
				<td>What every physician needs to know about abortion methods</td>
			</tr>
			<tr style="height:20px;">
				<td><a href="/wp-admin/edit.php?post_type=prh_news">PRH in the news</a></td>
				<td>Communicating press mentions involving PRH and its physicians. *Appears on Homepage and ‘Our Impact’ page</td>
				<td>Dr. Willie Parker in the New York Times: “If I Don’t, Who Will?”</td>
			</tr>
		</tbody>
	</table>

<?php }

function prh_menus_guide_widget() { ?>

	There are 3 menus managed in the <a href="/wp-admin/nav-menus.php">Navigation</a> area.
	<ul>
		<li>Main Menu</a></li>
		<li>Footer Sitemap</a></li>
		<li>Footer social links</li>
	</ul>
<?php }

function prh_members_guide_widget() { ?>
	Members are managed <a href="/wp-admin/admin.php?page=groups-admin">here.</a>
<?php }

function prh_lta_members_widget() {
	$description = false;
	require_once( ABSPATH . 'wp-includes/pluggable.php' );
	if ( $group = Groups_Group::read_by_name( 'LTA' ) ) {
		$description = $group->description;
	}
	?>
	<h2>Welcome Leadership Training Academy members</h2>
	<?php if ( $description ) : ?>
		<p><?php echo $description; ?></p>
	<?php endif; ?>
	<p>Please visit the <a href="/lta-welcome-page">LTA welcome page</a> to find resources and general info.</p>
<?php }

function prh_ps_members_widget() {
	$description = false;
	require_once( ABSPATH . 'wp-includes/pluggable.php' );
	if ( $group = Groups_Group::read_by_name( 'PS' ) ) {
		$description = $group->description;
	}
	?>
	<h2>Welcome Physician Safety members</h2>
	<?php if ( $description ) : ?>
		<p><?php echo $description; ?></p>
	<?php endif; ?>
	<p>Please visit the <a href="/ps-welcome-page">Physicians' Safety welcome page</a> to find resources and general info.</p>
<?php }

