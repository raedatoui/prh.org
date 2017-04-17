<?php

/**
 * Class PageModules
 * This class consumes the Custom Fields data for a given page and renders
 * the respective templates
 */
class PageModules {
	public $modules;
	public $keys;

	function __construct( $post_id ) {
		$groups = acf_get_field_groups( array( 'post_id' => $post_id ) );
		$modules = array();
		foreach( $groups as $group_key => $group ) {
			$module = acf_get_fields($group);
			$key = $group['title'];

			$modules[$key] = array('module_name' => $group['title']);
			foreach($module as $field_name => $field ) {
				$f = $field['name'];
				$modules[$key][$f] = get_field($f);
			}
		}
		$this->modules = $modules;
		$this->prepare();
		$this->configure();
		$this->filter();
		$this->sort();
		$this->keys = array_keys($this->modules);
	}

	function prepare() {
		foreach( COMPONENTS_TO_UNSET as $c ) {
			unset( $this->modules[$c] );
		}
		$filter = function ( $module ) {
			$config = MODULES[$module['module_name']];
			return $module[$config['options']] !== null;
		};
		$this->modules = array_filter( $this->modules, $filter );
	}

	function filter() {
		$filter = function ( $module ) {
			return $module['config'][MODULE_OPTIONS['enabled']] == 1;
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

	function render() {
		foreach ($this->modules as $module) {
			$mn = $module['config']['name'];
			$template = MODULES[$mn]['template'];
			if ( $module['is_aggregate']) {
				$module['query'] = $this->build_query( $module );
			}
			include( locate_template( $template, false, true ) );
		}
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
				$args['posts_per_page'] = $module[AGGREGATE_BY_CATEGORY['count']];
				break;
			case AGGREGATE_BY_POST_TYPE['name']:
				$args['post_type'] = $module[AGGREGATE_BY_POST_TYPE['post_type']];
				$args['posts_per_page'] = $module[AGGREGATE_BY_POST_TYPE['count']];
				break;
		}
		return new WP_Query( $args );
	}
}
