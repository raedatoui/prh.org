<?php

/************* Content Types *****************/
const CONTENT_TYPES = array(
	array( 'post', 'posts' ),
	array( 'page', 'pages'),
	array( 'press_release', 'press_releases' ),
	array( 'phys_story', 'phys_stories' ),
	array( 'prh_ipaper', 'prh_ipapers' ),
	array( 'prh_update', 'prh_updates' ),
	array( 'prh_report', 'prh_reports' ),
	array( 'prh_news', 'prh_news' ),
	array( 'prh_events', 'prh_events' )
);

const CONTENT_TYPES_LABELS = array(
	'post' => 'Article',
	'page' => 'Page',
	'press_release' => 'Press Release',
	'phys_story' => 'Story',
	'prh_ipaper' => 'Legal Publication',
	'prh_update' => 'Update',
	'prh_report' => 'Report',
	'prh_news' => 'In the News',
	'prh_events' => 'Event'
);

const CONTENT_TYPES_FOR_AGGREGATION = array(
	'post',
	'press_release',
	'phys_story',
	'prh_ipaper',
	'prh_update',
	'prh_report',
	'prh_news',
	'prh_events'
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

const ACCORDION_ITEM = array(
	'title' => 'accordion_title',
	'content' => 'accordion_content'
);

const ACCORDION_GROUP = array(
	'title' => 'accordion_group_title',
	'items' => 'accordion_group_items'
);

const ROUTING_BLOCK = array(
	'title' => 'routing_block_title',
	'text' => 'routing_block_text',
	'links' => 'routing_block_links',
	'link_url' => 'routing_block_link_url',
	'link_text' => 'routing_block_link_text'
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

const HOMEPAGE_HERO_MODULE = array(
	'name' => 'Homepage Hero',
	'title' => 'hero_title',
	'header' => 'hero_header',
	'text' => 'hero_text',
	'template' => 'template-parts/modules/homepage-hero.php'
);

const PAGE_HERO_MODULE = array(
	'name' => 'Page Hero',
	'header' => 'hero_header',
	'jump_links' => 'hero_jump_links',
	'template' => 'template-parts/modules/page-hero.php'
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
	'resources_enabled' => 'overview_resources_enabled',
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

const ACCORDION_SECTION = array(
	'enabled' => 'accordion_section_enabled',
	'name' => 'Accordion Section',
	'options' => 'accordion_section_options',
	'repeater' => 'accordion_groups',
	'template' => 'template-parts/modules/accordion-section.php'
);

const ROUTING_MODULE = array(
	'enabled' => 'routing_module_enabled',
	'name' => 'Routing Module',
	'options' => 'routing_module_options',
	'repeater' => 'routing_blocks',
	'template' => 'template-parts/modules/routing-module.php'
);

const DONATE_MODULE = array(
	'enabled' => 'donate_module_enabled',
	'name' => 'Donate Module',
	'headline' => 'donate_module_headline',
	'text' => 'donate_module_text', 
	'cta_text' => 'donate_module_cta_text',
	'cta_url' => 'donate_module_cta_url',
	'image' => 'donate_module_bg',
	'template' => 'template-parts/modules/donate.php'
);


/************* Mappings *****************/
const MODULES = array(
	CAROUSEL_MODULE['name'] => CAROUSEL_MODULE,
	HOMEPAGE_HERO_MODULE['name'] => HOMEPAGE_HERO_MODULE,
	PAGE_HERO_MODULE['name'] => PAGE_HERO_MODULE,
	STATISTICS_MODULE['name'] => STATISTICS_MODULE,
	AGGREGATE_BY_POST_TYPE['name'] => AGGREGATE_BY_POST_TYPE,
	AGGREGATE_BY_CATEGORY['name'] => AGGREGATE_BY_CATEGORY,
	QUOTE_MODULE['name'] => QUOTE_MODULE,
	OVERVIEW_MODULE['name'] => OVERVIEW_MODULE,
	SPOTLIGHT_1_MODULE['name'] => SPOTLIGHT_1_MODULE,
	SPOTLIGHT_3_MODULE['name'] => SPOTLIGHT_3_MODULE,
	TAB_PANEL['name'] => TAB_PANEL,
	ACCORDION_SECTION['name'] => ACCORDION_SECTION,
	ROUTING_MODULE['name'] => ROUTING_MODULE,
	DONATE_MODULE['name'] => DONATE_MODULE
);

const AGGREGATES = array(
	AGGREGATE_BY_CATEGORY['name'],
	AGGREGATE_BY_POST_TYPE['name']
);

const HEROS = array(
	HOMEPAGE_HERO_MODULE['name'],
	PAGE_HERO_MODULE['name']
);


/************* Stylistic stuff *****************/

const PRH_COLORS = array(
	'white' => '#ffffff',
	'sand' => '#f3ebde',
	'paper' => '#fff7f1',
	'cream' => '#fff1e6',
	'tan' => '#f1ebe6',
	'red' => '#e84d6a',
	'peach' => '#ffd1c7',
	'gray' => '#999999',
	'black' => '#333333',
	'blue' => '#006bb8',
	'navy' => '#2e3563',
	'sky' => '#b7d5fb'
	);
