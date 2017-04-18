<?php

/**
 * Path to WordPress installation root
 * Default path './'
 */
define( 'PATH_TO_WORDPRESS', '../../../../' ); # Default WordPress install location

// Require WordPress environment
require PATH_TO_WORDPRESS . 'wp-load.php';

/**
 * Class PostTypeMigration
 * Takes CSV and a post type are args and deletes the posts that are listed
 * in the CSV
 */
class PostTypeMigration {
	private $keeps = array();
	private $all = array();
	private $post_type;
	// every item in the CSV should exist in the db
	private $intersections;
	private $host;

	/**
	 * PostTypeMigration constructor.
	 * Everything is done in the constructor.
	 * @param $post_type
	 * @param $content_file
	 */
	function __construct( $post_type, $content_file ) {
		$this->host = 'http://' . $_SERVER['SERVER_NAME'];
		$this->post_type = $post_type;

		// the CSV contains permalinks without the host
		// allowing this script to run on multiple environments.
		$append_host = function( $url ) {
			return $this->host . $url;
		};

		$this->keeps = array_map( $append_host, $this->read_csv($content_file) );

		$this->all = $this->get_posts();

		echo "total: " . count( $this->all ) . "  keeps: " .
			count( $this->keeps ) . "<br>";

		$keep_filter = function ( $value ) {
			$url = $value[0];
			return in_array( $url, $this->keeps);
		};

		$url_only = function ( $value ) {
			return $value[0];
		};
		$this->intersections = array_map(
			$url_only, array_filter( $this->all, $keep_filter ) );

		$delete_filter = function ( $value ) {
			$url = $value[0];
			return !in_array( $url, $this->intersections );
		};
		$deletes = array_filter( $this->all, $delete_filter );

		echo count( $this->intersections ) . " in common, " .
			count($deletes)  . " to delete<br>";

		// Trash the post to be deleted.
		foreach ($deletes as $del) {
			echo $del[1] . " - ";
			wp_trash_post($del[1]);
		}
	}

	/**
	 * Reads a CSV file and returns a flat array. Assumes the CSV has 1000 rows.
	 * @param $file
	 * @return array
	 */
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

	/**
	 * Get all posts by post type. Only get published posts since the audit is
	 * conducted against published content.
	 * @return array
	 */
	function get_posts() {
		$result = array();

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
			array_push( $result, $p );
		}
		return $result;
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