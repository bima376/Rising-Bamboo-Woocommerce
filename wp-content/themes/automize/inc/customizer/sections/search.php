<?php
/**
 * RisingBambooTheme Package
 *
 * @package RisingBambooTheme
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Customizer\Helper as CustomizerHelper;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;
use RisingBambooTheme\Helper\Helper;

$priority = 1;

RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
	[
		'title'         => esc_html__('Search', 'automize'),
		'panel'         => RISING_BAMBOO_KIRKI_PANEL_COMPONENT,
		'description'   => esc_html__('This section contains advanced configurations for search.', 'automize'),
	]
);

/**
 * Search Configration.
 */

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Feature', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_OVERLAY,
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'label'       => esc_html__('Popup', 'automize'),
		'description' => esc_html__('Show search component as popup.', 'automize'),
		'priority'    => $priority++,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_OVERLAY),
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_BY_CATEGORY,
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'label'    => esc_html__('Search by Category', 'automize'),
		'priority' => $priority++,
		'default'  => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_BY_CATEGORY),
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_AJAX,
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'label'    => esc_html__('Ajax Search', 'automize'),
		'priority' => $priority++,
		'default'  => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_AJAX),
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'slider',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_RESULT_LIMIT,
		'label'       => esc_html__('Result Limit', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_RESULT_LIMIT),
		'priority'    => $priority++,
		'choices'     => [
			'min'  => 1,
			'max'  => 100,
			'step' => 1,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'slider',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_RESULT_COLUMN,
		'label'       => esc_html__('Result Columns', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_RESULT_COLUMN),
		'priority'    => $priority++,
		'choices'     => [
			'min'  => 1,
			'max'  => 12,
			'step' => 1,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'textarea',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_POPULAR_KEYWORD,
		'label'       => esc_html__('Popular Keywords', 'automize'),
		'description' => esc_html__('Separated by a new line or comma.', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'priority'    => $priority++,
	]
);

/**
 * Search Style.
 */

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Style', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'rbb-icons',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON,
		'label'       => esc_html__('Icon', 'automize'),
		'description' => esc_html__('Choose the search icon ?', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON),
		'priority'    => $priority++,
		'choices'     => Helper::get_rbb_icons('search'),
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'slider',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON_SIZE,
		'label'       => esc_html__('Icon Size', 'automize'),
		'description' => esc_html__('Unit : Pixel', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON_SIZE),
		'priority'    => $priority++,
		'choices'     => [
			'min'  => 10,
			'max'  => 100,
			'step' => 1,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON_COLOR,
		'label'       => esc_html__('Icon Color', 'automize'),
		'description' => esc_html__('Change the icon color?', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON_COLOR),
		'priority'    => $priority++,
		'choices'     => [
			'alpha' => true,
		],
	] 
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'slider',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON_BORDER,
		'label'       => esc_html__('Icon Border', 'automize'),
		'description' => esc_html__('Unit : Pixel', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON_BORDER),
		'priority'    => $priority++,
		'choices'     => [
			'min'  => 0,
			'max'  => 5,
			'step' => 0.5,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_INPUT_COLOR,
		'label'       => esc_html__('Input Color', 'automize'),
		'description' => esc_html__('Change the input color ?', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_INPUT_COLOR),
		'priority'    => $priority++,
		'choices'     => [
			'alpha' => true,
		],
	] 
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'dimension',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON_BORDER_RADIUS,
		'label'           => esc_html__('Icon Border Radius', 'automize'),
		'description'     => __('Control <a target="_blank" href="https://developer.mozilla.org/en-US/docs/Web/CSS/border-radius"> border radius</a>.', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON_BORDER_RADIUS),
		'priority'        => $priority++,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON_BORDER,
				'operator' => '!==',
				'value'    => '0',
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'color',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON_BORDER_COLOR,
		'label'           => esc_html__('Icon Border Color', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON_BORDER_COLOR),
		'priority'        => $priority++,
		'choices'         => [
			'alpha' => true,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON_BORDER,
				'operator' => '!==',
				'value'    => '0',
			],
		],
	] 
);

/**
 * Search Content.
 */

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'slider',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_INPUT_BORDER,
		'label'       => esc_html__('Input Border', 'automize'),
		'description' => esc_html__('Unit : Pixel', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_INPUT_BORDER),
		'priority'    => $priority++,
		'choices'     => [
			'min'  => 0,
			'max'  => 5,
			'step' => 0.5,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'color',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_INPUT_BORDER_COLOR,
		'label'           => esc_html__('Input Border Color', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_INPUT_BORDER_COLOR),
		'priority'        => $priority++,
		'choices'         => [
			'alpha' => true,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_INPUT_BORDER,
				'operator' => '!==',
				'value'    => '0',
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'dimension',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_INPUT_BORDER_RADIUS,
		'label'           => esc_html__('Input Border Radius', 'automize'),
		'description'     => __('Control <a target="_blank" href="https://developer.mozilla.org/en-US/docs/Web/CSS/border-radius"> border radius</a>.', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_SEARCH,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_INPUT_BORDER_RADIUS),
		'priority'        => $priority++,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_INPUT_BORDER,
				'operator' => '!==',
				'value'    => '0',
			],
		],
	]
);
