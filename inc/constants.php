<?php
/************* Modules & Components *****************/
const COMPONENTS_TO_UNSET = array(
	'CTA',
	'Module Options',
	'Statistic',
	'Spotlight card'
);

const MODULE_OPTIONS = array(
	'enabled' => 'module_enabled',
	'order' => 'module_order',
	'title' => 'module_title',
	'use_cta' => 'module_use_cta',
	'cta' => 'module_cta'
);

const CTA_COMPONENT = array (
	'label' => 'cta_label',
	'link'=> 'cta_link'
);

const CAROUSEL_MODULE = array(
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
	'name' => 'Hero',
	'options' => 'hero_options',
	'header' => 'hero_header',
	'text' => 'hero_text',
	'template' => 'template-parts/modules/hero.php'
);

const STATISTICS_MODULE = array(
	'name' => 'Statistics',
	'options' => 'statistics_options',
	'figures' => 'statistics_figures',
	'figure' => 'statistic_figure',
	'number' => 'stat_number',
	'text' => 'stat_text',
	'template' => 'template-parts/modules/statistics.php'
);

const QUOTE_MODULE = array(
	'name' => 'Quote',
	'options' => 'quote_options',
	'quote' => 'quote',
	'attribution_name' => 'quote_attribution_name',
	'attribution_location' => 'quote_attribution_location',
	'text' => 'quote_text',
	'template' => 'template-parts/modules/quote.php'
);

const OVERVIEW_MODULE = array(
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
	'name' => 'Aggregate by Content Type',
	'options' => 'aggregate_by_post_type_options',
	'post_type' => 'content_type_aggregate',
	'count' => 'aggregate_by_post_type_count',
	'template' => 'template-parts/modules/aggregate.php'
);

const AGGREGATE_BY_CATEGORY = array(
	'name' => 'Aggregate by Category',
	'options' => 'aggregate_by_category_options',
	'category' => 'category_aggregate',
	'count' => 'aggregate_by_category_count',
	'template' => 'template-parts/modules/aggregate.php'
);

const SPOTLIGHT_1_MODULE = array(
	'name' => 'Spotlight 1 Module',
	'options' => 'spotlight_1_options',
	'card' => 'spotlight_1_card',
	'template' => 'template-parts/modules/spotlightone.php'
);

const SPOTLIGHT_3_MODULE = array(
	'name' => 'Spotlight 3 Module',
	'options' => 'spotlight_3_options',
	'repeater' => 'spotlight_3_repeater',
	'card' => 'spotlight_3_card',
	'template' => 'template-parts/modules/spotlightthree.php'
);

const SPOTLIGHT_CARD = array(
	'name' => 'Spotlight card',
	'image' => 'spotlight_image',
	'headline' => 'spotlight_headline',
	'text' => 'spotlight_text',
	'use_cta' => 'spotlight_use_cta',
	'cta' => 'spotlight_cta'
);

const MODULES = array(
	CAROUSEL_MODULE['name'] => CAROUSEL_MODULE,
	HERO_MODULE['name'] => HERO_MODULE,
	STATISTICS_MODULE['name'] => STATISTICS_MODULE,
	AGGREGATE_BY_POST_TYPE['name'] => AGGREGATE_BY_POST_TYPE,
	AGGREGATE_BY_CATEGORY['name'] => AGGREGATE_BY_CATEGORY,
	QUOTE_MODULE['name'] => QUOTE_MODULE,
	OVERVIEW_MODULE['name'] => OVERVIEW_MODULE,
	SPOTLIGHT_1_MODULE['name'] => SPOTLIGHT_1_MODULE,
	SPOTLIGHT_3_MODULE['name'] => SPOTLIGHT_3_MODULE
);

const AGGREGATES = array(
	AGGREGATE_BY_CATEGORY['name'],
	AGGREGATE_BY_POST_TYPE['name']
);

const CUSTOM_POST_TYPES = array (
	'press_release' => 'Press Release'
);
