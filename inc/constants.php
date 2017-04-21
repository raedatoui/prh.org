<?php

// Content Types
const CONTENT_TYPES = array(
	array('post', 'posts'),
	array('page', 'pages'),
	array('press_release', 'press_releases'),
	array('phys_story', 'phys_stories'),
	array('prh_ipaper', 'prh_ipapers'),
	array('prh_update', 'prh_updates'),
	array('prh_report', 'prh_reports'),
	array('prh_news', 'prh_news')
);

/************* Components *****************/
const MODULE_OPTIONS = array(
	'order' => 'module_order',
	'title' => 'module_title',
	'use_cta' => 'module_use_cta',
	'cta' => 'module_cta'
);

const CTA_COMPONENT = array (
	'label' => 'cta_label',
	'link'=> 'cta_link'
);

const SPOTLIGHT_CARD = array(
	'name' => 'Spotlight Card',
	'image' => 'spotlight_image',
	'headline' => 'spotlight_headline',
	'text' => 'spotlight_text',
	'use_cta' => 'spotlight_use_cta',
	'cta' => 'spotlight_cta'
);

const TAB_CARD = array(
	'name' => 'Tab Card',
	'image' => 'tab_card_image',
	'title' => 'tab_card_title',
	'text' => 'tab_card_text',
	'cta' => 'tab_card_cta'
);

const STATISTIC_CARD = array(
	'number' => 'stat_number',
	'text' => 'stat_text',
);


/************* Modules *****************/
const CAROUSEL_MODULE = array(
	'enabled' => 'carousel_enabled',
	'name' => 'Carousel',
	'options' => 'carousel_options',
	'slides' => 'carousel_slides',
	'image' => 'slide_image',
	'eyebrow' => 'slide_eyebrow',
	'title' => 'slide_title',
	'text' => 'slide_text',
	'cta' => 'slide_cta',
	'link' => 'slide_link',
	'template' => 'template-parts/modules/carousel.php'
);

const HERO_MODULE = array(
	'enabled' => 'hero_enabled',
	'name' => 'Hero',
	'options' => 'hero_options',
	'header' => 'hero_header',
	'text' => 'hero_text',
	'template' => 'template-parts/modules/hero.php'
);

const STATISTICS_MODULE = array(
	'enabled' => 'statistics_enabled',
	'name' => 'Statistics',
	'options' => 'statistics_options',
	'repeater' => 'statistics_cards',
	'card' => 'statistic_card',
	'template' => 'template-parts/modules/statistics.php'
);

const QUOTE_MODULE = array(
	'enabled' => 'quote_enabled',
	'name' => 'Quote',
	'options' => 'quote_options',
	'quote' => 'quote',
	'attribution_name' => 'quote_attribution_name',
	'attribution_location' => 'quote_attribution_location',
	'text' => 'quote_text',
	'template' => 'template-parts/modules/quote.php'
);

const OVERVIEW_MODULE = array(
	'enabled' => 'overview_enabled',
	'name' => 'Overview',
	'options' => 'overview_options',
	'content' => 'overview_content',
	'resources_title' => 'overview_resources_title',
	'resources_links' => 'overview_resource_links',
	'resources_link_text' => 'overview_resource_link_text',
	'resources_link_url' => 'overview_resource_link_url',
	'template' => 'template-parts/modules/overview.php'
);

const AGGREGATE_BY_POST_TYPE = array(
	'enabled' => 'aggregate_by_post_type_enabled',
	'name' => 'Aggregate by Content Type',
	'options' => 'aggregate_by_post_type_options',
	'post_type' => 'content_type_aggregate',
	'count' => 'aggregate_by_post_type_count',
	'template' => 'template-parts/modules/aggregate.php'
);

const AGGREGATE_BY_CATEGORY = array(
	'enabled' => 'aggregate_by_category_enabled',
	'name' => 'Aggregate by Category',
	'options' => 'aggregate_by_category_options',
	'category' => 'category_aggregate',
	'count' => 'aggregate_by_category_count',
	'template' => 'template-parts/modules/aggregate.php'
);

const SPOTLIGHT_1_MODULE = array(
	'enabled' => 'spotlight_1_enabled',
	'name' => 'Spotlight 1 Module',
	'options' => 'spotlight_1_options',
	'card' => 'spotlight_1_card',
	'template' => 'template-parts/modules/spotlightone.php'
);

const SPOTLIGHT_3_MODULE = array(
	'enabled' => 'spotlight_3_enabled',
	'name' => 'Spotlight 3 Module',
	'options' => 'spotlight_3_options',
	'repeater' => 'spotlight_3_repeater',
	'card' => 'spotlight_3_card',
	'template' => 'template-parts/modules/spotlightthree.php'
);

const TAB_PANEL = array(
	'enabled' => 'tab_panel_enabled',
	'name' => 'Tab Panel',
	'options' => 'tab_panel_options',
	'headline' => 'tab_panel_headline',
	'repeater' => 'tab_panel_tabs',
	'card' => 'tab_card',
	'template' => 'template-parts/modules/tabs.php'
);


/************* Mappings *****************/
const MODULES = array(
	CAROUSEL_MODULE['name'] => CAROUSEL_MODULE,
	HERO_MODULE['name'] => HERO_MODULE,
	STATISTICS_MODULE['name'] => STATISTICS_MODULE,
	AGGREGATE_BY_POST_TYPE['name'] => AGGREGATE_BY_POST_TYPE,
	AGGREGATE_BY_CATEGORY['name'] => AGGREGATE_BY_CATEGORY,
	QUOTE_MODULE['name'] => QUOTE_MODULE,
	OVERVIEW_MODULE['name'] => OVERVIEW_MODULE,
	SPOTLIGHT_1_MODULE['name'] => SPOTLIGHT_1_MODULE,
	SPOTLIGHT_3_MODULE['name'] => SPOTLIGHT_3_MODULE,
	TAB_PANEL['name'] => TAB_PANEL
);

const AGGREGATES = array(
	AGGREGATE_BY_CATEGORY['name'],
	AGGREGATE_BY_POST_TYPE['name']
);

const CUSTOM_POST_TYPES = array (
	'press_release' => 'Press Release'
);


/************* Housekeeping *****************/
const COMPONENTS_TO_UNSET = array(
	'CTA',
	'Module Options',
	'Statistic',
	'Spotlight Card',
	'Tab Card'
);

