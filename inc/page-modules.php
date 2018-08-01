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
	public $is_voc;
	public $module_class_name;
	
	function __construct( $post_id, $is_voc = false ) {
		$this->is_voc = $is_voc;
		if ($is_voc == true) {
			$this->module_class_name = 'voc';
		}
		$groups = acf_get_field_groups( array( 'post_id' => $post_id ) );
		$modules = array();
		foreach( $groups as $group_key => $group ) {
			$module = acf_get_fields($group);
			$key = $group['title'];

			$modules[$key] = array(
				'module_name' => $group['title']
			);
			foreach($module as $field_name => $field ) {
				$f = $field['name'];
				if ($f != '') {
					$modules[$key][$f] = get_field($f);
				}
			}
		}
		$this->modules = $modules;
	}

	function printModules() {
		print("<pre><code>");
		$func = function ( $module ) {
			return $module;
		};
		$configs = array_map( $func, $this->modules );
		print_r(htmlspecialchars(json_encode($configs, JSON_PRETTY_PRINT)));
		print("</code></pre>");
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
			unset( $this->modules[$hero_name] );
		}

		if ( $has_donate ) {
			$this->donate = $this->modules[$donate_name];
			$this->donate['config'] = MODULES[$donate_name];
			unset( $this->modules[$donate_name]);
		}
		$voc_form_name = MODULES['VOC Form']['name'];
		$voc_categories_name = MODULES['VOC Categories']['name'];

		if ($this->is_voc == true) {
			$this->modules[$voc_form_name] = array(
				'module_name' => 'VOC Form',
				'voc_form_enabled' => 1,
				'voc_form_options' => array(array(
					'enabled' => 'voc_form_enabled',
					'name' => 'VOC Form',
					'module_title' => 'Share your story',
					'module_order' => 0,
					'module_use_cta' => false,
					'module_show_in_hero' => false
				))
			);

			$this->modules[$voc_categories_name] = array(
				'module_name' => 'VOC Categories',
				'voc_categories_enabled' => 1,
				'voc_categories_options' => array(array(
					'enabled' => 'voc_categories_enabled',
					'name' => 'VOC Categories',
					'module_title' => 'Search Stories',
					'module_order' => 0,
					'module_use_cta' => false,
					'module_show_in_hero' => false
				))
			);
		}
		
		$this->prepare();
		$this->configure();
		$this->filter();
		if ($this->is_voc) {
			$this->modules[$voc_form_name]['config']['module_order'] = count($this->modules) - 1;
			$this->modules[$voc_categories_name]['config']['module_order'] = count($this->modules);
		}
		$this->sort();
		//TODO remap the configs to set the count based on the sorted instead of the value of the order
		// becasue the value can sometime be 0 or some abitrary number set by the user ie 41
		$this->keys = array_keys($this->modules);

	}

	function prepare() {
		$filter = function ( $module ) {
			$config = MODULES[$module['module_name']];
			return array_key_exists('options', $config) && $module[$config['options']] !== null;
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
			$x = (int)$a['config'][MODULE_OPTIONS['order']];
			$y = (int)$b['config'][MODULE_OPTIONS['order']];
			if ($x == $y) {
				return 0;
			}
			return ($x < $y) ? -1 : 1;
		};
		uasort( $this->modules, $cmp );
	}

	function module_titles() {
		$mapper = function ( $module ) {
			return $module['config'][MODULE_OPTIONS['title']];
		};
		$filter = function ( $module ) {
			return ($module['config'][MODULE_OPTIONS['use_jump_link']] && $module['config'][MODULE_OPTIONS['title']]);
		};

		return array_map( $mapper, array_filter( $this->modules, $filter ) );
	}

	function accordion_titles() {
		$mapper = function ( $group ) {
			return $group[ACCORDION_GROUP['title']];
		};
		$filter = function ( $group ) {
			return $group[ACCORDION_GROUP['use_jump_link']];
		};
		$section = $this->modules[ACCORDION_SECTION['name']];
		return array_map( $mapper, array_filter( $section[ACCORDION_SECTION['repeater']], $filter ) );
	}

	function jump_links() {
		$jump_links = array();
		foreach ( $this->module_titles() as $index => $title ) {
			$jump_links[$index]['pretty'] = $title;
			$jump_links[$index]['slug'] = sanitize_module_title($title);
		}

		$accordion_links = array();
		if ( in_array( ACCORDION_SECTION['name'], $this->keys ) ) {
			$accordions = $this->accordion_titles();
			foreach ( $accordions as $index => $title ) {
				$accordion_links[$index]['pretty'] = $title;
				$accordion_links[$index]['slug'] = sanitize_module_title($title);
			}
		}
		return array_merge( $jump_links, $accordion_links ) ;
	}

	function render_hero() {
		if ($this->hero != null ) {
			$module = $this->hero;
			if ( $this->hero['config']['name'] === HOMEPAGE_HERO_MODULE['name'] ) {
				$module_title = $this->hero[$this->hero['config']['title']];
			} else {
				$module_title = get_the_title();
			}
			$banner = null;
			$class_name = null;
			if (array_key_exists('banner', $this->hero))
				$banner = $this->hero['banner'];
			if (array_key_exists('class_name', $this->hero))
				$class_name = $this->hero['class_name'];

			$show_numbered_titles = $this->is_voc;
			$module_class_name = $this->module_class_name;
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
			$module_order = $module['config'][MODULE_OPTIONS['order']];
			$show_numbered_titles = $this->is_voc;
			$module_class_name = $this->module_class_name;
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

/**
 * Compute the anchor field from the group title. This function is only called
 * for pages that use the Accordion Section group.
 */
function prh_acf_update_accordions( $value, $post_id, $field  ) {

	remove_filter('acf/update_value/name=accordion_groups', 'prh_acf_update_accordions', 10, 3);

	$groups = get_field( $field['name'], $post_id );
	$permalink = get_the_permalink( $post_id );

	foreach ( $groups as $index => $group ) {
		$title = $group[ACCORDION_GROUP['title']];
		$anchor = $permalink . "#" . sanitize_module_title( $title );
		$group[ACCORDION_GROUP['anchor']] = $anchor;
		$groups[$index] = $group;
	}

	update_field( $field['key'], $groups, $post_id );
	add_filter( 'acf/update_value/name=accordion_groups', 'prh_acf_update_accordions', 10, 3 );
	return $value;
}
add_filter( 'acf/update_value/name=accordion_groups', 'prh_acf_update_accordions', 10, 3 );
