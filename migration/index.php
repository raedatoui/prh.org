<?php

/**
 * Path to WordPress installation root
 * Default path './'
 */
define( 'PATH_TO_WORDPRESS', '../../../../' ); # Default WordPress install location

// Require WordPress environment
require PATH_TO_WORDPRESS . 'wp-load.php';


class BaseMigration {
	private $host;
	private $csv_file;
	public $post_type;
	public $wp_permalink_fn;
	/**
	 * BaseMigration constructor.
	 * @param $csv_file
	 * @param $post_type optional post type
	 */
	function __construct( $csv_file, $post_type ) {
		$this->host = 'http://' . $_SERVER['SERVER_NAME'];
		$this->csv_file = $csv_file;
		$this->post_type = $post_type;
	}

	/**
	 * Reads a CSV file and returns a flat array. Assumes the CSV has 1000 rows.
	 * @return array
	 */
	function read_csv() {
		$rows = array();
		if (($handle = fopen($this->csv_file, "r")) !== FALSE ) {
			while ( ( $data = fgetcsv($handle, 1000, ",") ) !== FALSE ) {
				array_push($rows, $data[0]);
			}
			fclose($handle);
		}
		// the CSV contains permalinks without the host
		// allowing this script to run on multiple environments.
		$append_host = function( $url ) {
			return $this->host . $url;
		};
		return array_map( $append_host, $rows );
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
			'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash' ),
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
/**
 * Class PostTypeMigration
 * Takes CSV and a post type are args and deletes the posts that are listed
 * in the CSV
 */
class PostTypeMigration extends BaseMigration {
	private $keeps = array();
	private $all = array();
	// every item in the CSV should exist in the db
	private $intersections;

	/**
	 * PostTypeMigration constructor.
	 * Everything is done in the constructor.
	 * @param $csv_file
	 * @param null $post_type
	 */
	function __construct( $csv_file, $post_type ) {
		parent::__construct( $csv_file, $post_type );

		$this->keeps = $this->read_csv();
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
}

/**
 * Class MediaMigration
 * This class acts differently, where media files listed in the CSV are deleted
 * instead of kept. Also uses the wp_delete_attachement
 */
class MediaMigration extends BaseMigration {
	private $deletes;
	private $all;

	function __construct( $csv_file, $post_type ) {
		parent::__construct( $csv_file, $post_type );
		$this->deletes = $this->read_csv();
		$this->cleanup();
//		foreach($this->deletes as $k) {
//			if( url_to_postid($k) == 0 ) {
//				echo $k . "<br>";
//			}
//		}
	}

	function cleanup() {
		$this->all = $this->get_posts();

		echo "total: " . count( $this->all ) . "  deletes: " .
			count( $this->deletes ) . "<br>";

		$keep_filter = function ( $value ) {
			$url = $value[0];
			return in_array( $url, $this->deletes);
		};

		$url_only = function ( $value ) {
			return $value[0];
		};

		$intersections = array_filter( $this->all, $keep_filter );

		echo count( $intersections ) . " in common, " .
			count( $intersections )  . " to delete<br>";
		// Trash the post to be deleted.
		foreach ( $intersections as $del ) {
			echo $del[1] . " - ";
			wp_delete_attachment($del[1]);
		}
	}

}
new MediaMigration( 'media-missing.csv', 'attachment' );
echo "<br>---------------<br>---------------<br>";
new PostTypeMigration( 'posts.csv', 'post' );
echo "<br>---------------<br>---------------<br>";
new PostTypeMigration( 'press.csv', 'press_release' );
//echo "<br>---------------<br>---------------<br>";
//new PostTypeMigration( 'stories.csv', 'phys_story' );
echo "<br>---------------<br>---------------<br>";
new PostTypeMigration( 'papers.csv', 'prh_ipaper' );


// We're done!
exit;
?>