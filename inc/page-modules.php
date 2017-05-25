<?php

/**
 * Class PageModules
 * This class consumes the Custom Fields data for a given page and renders
 * the respective templates
 */
class PageModules {
	public $modules;
	public $keys;
	public $hero;
	public $donate;

	function __construct( $post_id ) {
		$groups = acf_get_field_groups( array( 'post_id' => $post_id ) );
		$modules = array();
		foreach( $groups as $group_key => $group ) {
			$module = acf_get_fields($group);
			$key = $group['title'];

			$modules[$key] = array(
				'module_name' => $group['title'],
				'module_order' => $group_key,
				'module_id' => $group['key']
			);
			foreach($module as $field_name => $field ) {
				$f = $field['name'];
				$modules[$key][$f] = get_field($f);
			}
		}
		$this->modules = $modules;
	}

	function init() {

		// Separate out hero and donation modules, which have fixed positions on the page
		$hero_name = MODULES['Homepage Hero']['name'];
		$donate_name = MODULES['Donate Module']['name'];

		// $has_hero = array_key_exists('Page Hero', $this->modules);
		$has_hero = array_key_exists($hero_name, $this->modules);
		$has_donate = array_key_exists($donate_name, $this->modules);

		if ( $has_hero ) {
			$this->hero = $this->modules[$hero_name];
			$this->hero['config'] = MODULES[$hero_name];
			unset( $this->modules[$hero_key] );
		}

		if ( $has_donate ) {
			$this->donate = $this->modules[$donate_name];
			$this->donate['config'] = MODULES[$donate_name];
			unset( $this->modules[$donate_name]);
		}

		$this->prepare();
		$this->configure();
		$this->filter();
		$this->sort();
		$this->keys = array_keys($this->modules);
	}

	function prepare() {
		$filter = function ( $module ) {
			$config = MODULES[$module['module_name']];
			return $module[$config['options']] !== null;
		};
		$this->modules = array_filter( $this->modules, $filter );
	}

	function filter() {
		$filter = function ( $module ) {
			$enabled_field = $module['config']['enabled'];
			return $module[$enabled_field] == 1;
		};
		$this->modules = array_filter( $this->modules, $filter );
	}

	function configure() {
		$func = function ( $module ) {
			if ( ! in_array( $module['module_name'], array_keys( MODULES ) ) ) {
				throw new Exception('Module ' . $module['module_name'] . ' not found');
			}
			$config = MODULES[$module['module_name']];
			if (! in_array( 'options', array_keys( $config ) ) ) {
				throw new Exception('Module found but not properly configured');
			}
			// unroll module options into $config object
			$options = $module[$config['options']][0];
			$config = array_merge( $config, $options );
			// remove module_options field from module
			unset( $module[$config['options']] );
			unset( $module['module_name'] );
			// remove old options key from const
			unset( $config ['options'] );
			$module['config'] = $config;
			if ( in_array( $module['config']['name'], AGGREGATES ) ) {
				$module['is_aggregate'] = true;
			} else {
				$module['is_aggregate'] = false;
			}
			return $module;
		};
		$this->modules = array_map( $func, $this->modules );
	}

	function sort() {
		$cmp = function ($a, $b) {
			$x = $a['config'][MODULE_OPTIONS['order']];
			$y = $b['config'][MODULE_OPTIONS['order']];
			if ($x == $y) {
				return 0;
			}
			return ($x < $y) ? -1 : 1;
		};
		uasort( $this->modules, $cmp );
	}

	function module_titles() {
		$func = function ( $module ) {
			return $module['config'][MODULE_OPTIONS['title']];
		};
		$filter = function ( $module ) {
			return $module['config'][MODULE_OPTIONS['use_jump_link']];
		};
		return array_map( $func, array_filter( $this->modules, $filter ) );
	}

	function jump_links() {
		$jump_links = array();
		foreach ( $this->module_titles() as $index => $title ) {
			$jump_links[$index]['pretty'] = $title;
			$jump_links[$index]['slug'] = sanitize_title($title);
		}
		return $jump_links;
	}

	function render_hero() {
		if ($this->hero != null ) {
			$module = $this->hero;
			if ( $this->hero['config']['name'] === HOMEPAGE_HERO_MODULE['name'] ) {
				$module_title = $this->hero[$this->hero['config']['title']];
			} else {
				$module_title = get_the_title();
			}
			include( locate_template( $module['config']['template'], false, true ) );
		}
	}

	function render_modules() {
		foreach ($this->modules as $module) {
			$mn = $module['config']['name'];
			$template = MODULES[$mn]['template'];
			if ( $module['is_aggregate']) {
				$module['query'] = $this->build_query( $module );
			}
			$module_title = $module['config'][MODULE_OPTIONS['title']];
			include( locate_template( $template, false, true ) );
		}
	}

	function render_donate_module() {
		if ($this->donate != null ) {
			$module = $this->donate;
			$enabled_field = $module['config']['enabled'];

			if ( $module[$enabled_field]) {
				include( locate_template( $module['config']['template'], false, true ) );
			}
		}
	}

	function render() {
		$this->render_hero();
		$this->render_modules();
		$this->render_donate_module();
	}


	function build_query( $module ) {
		$args = array(
			'post_status' => array( 'publish' ),
			'orderby' => 'date',
			'order'   => 'DESC',
		);
		switch ( $module['config']['name'] ) {
			case AGGREGATE_BY_CATEGORY['name']:
				$args['cat'] = $module[AGGREGATE_BY_CATEGORY['category']];
				$args['post_type'] = CONTENT_TYPES_FOR_AGGREGATION;
				$args['posts_per_page'] = $module[AGGREGATE_BY_CATEGORY['count']];
				break;
			case AGGREGATE_BY_POST_TYPE['name']:
				$args['post_type'] = $module[AGGREGATE_BY_POST_TYPE['post_type']];
				$args['posts_per_page'] = $module[AGGREGATE_BY_POST_TYPE['count']];
				break;
			case AGGREGATE_BY_TAG['name']:
				$args['tag'] = $module[AGGREGATE_BY_TAG['tag']]->slug;
				$args['post_type'] = CONTENT_TYPES_FOR_AGGREGATION;
				$args['posts_per_page'] = $module[AGGREGATE_BY_TAG['count']];
				break;
		}
		return new WP_Query( $args );
	}
}
