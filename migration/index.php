<?php

/**
 * Path to WordPress installation root
 * Default path './'
 */
define( 'PATH_TO_WORDPRESS', '../../../../' ); # Default WordPress install location

// Require WordPress environment
require PATH_TO_WORDPRESS . 'wp-load.php';


class PostTypeMigration {
	private $keeps = array();
	private $all = array();
	private $post_type;
	// every item in the CSV should exist in the db
	private $intersections;
	private $host;

	function __construct( $post_type, $content_file ) {
		$this->host = 'http://' . $_SERVER['SERVER_NAME'];
		$this->post_type = $post_type;

		$append_host = function( $url ) {
			return $this->host . $url;
		};

		$this->keeps = array_map( $append_host, $this->read_csv($content_file) );

		$this->get_posts();

		echo "total: " . count($this->all) . "  keeps: " . count($this->keeps) . "<br>";

		$filter = function ( $value ) {
			$url = $value[0];
			return in_array( $url, $this->keeps);
		};

		$url_only = function ( $value ) {
			return $value[0];
		};
		$this->intersections = array_map( $url_only, array_filter( $this->all, $filter ) );


		$filter3 = function ( $value ) {
			$url = $value[0];
			return !in_array( $url, $this->intersections);
		};
		$deletes = array_filter($this->all, $filter3);

		echo count($this->intersections) . " in common, " . count($deletes)  . " to delete<br>";
		foreach ($deletes as $del) {
			echo $del[1] . " - ";
//			wp_trash_post($del[1]);
		}
	}

	function read_csv( $file ) {
		$rows = array();
		if (($handle = fopen($file, "r")) !== FALSE) {
			while ( ( $data = fgetcsv($handle, 1000, ",") ) !== FALSE) {
				array_push($rows, $data[0]);
			}
			fclose($handle);
		}
		return $rows;
	}

	function get_posts() {
		$export_query = array(
			'posts_per_page' => -1,
			'post_type' => array( $this->post_type )
		);

		$posts = new WP_Query( $export_query );
		$posts = $posts->posts;

		foreach ( $posts as $post ) {
			$p = array(
				get_permalink( $post->ID ),
				$post->ID
			);
			array_push( $this->all, $p );
		}
	}
}

new PostTypeMigration('post', 'posts.csv');
echo "<br>---------------<br>---------------<br>";
new PostTypeMigration('press_release', 'press.csv');
echo "<br>---------------<br>---------------<br>";
new PostTypeMigration('phys_story', 'stories.csv');
echo "<br>---------------<br>---------------<br>";
new PostTypeMigration('prh_ipaper', 'papers.csv');

// We're done!
exit;
?>