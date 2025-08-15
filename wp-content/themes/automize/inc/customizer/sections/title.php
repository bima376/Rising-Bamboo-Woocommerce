<?php
/**
 * The header section.
 *
 * @package Rising_Bamboo
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Customizer\Helper;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;

$priority = 1;
RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_LAYOUT_TITLE,
	[
		'title'          => esc_html__('Page Title', 'automize'),
		'description'    => esc_html__('Page Title Configuration.', 'automize'),
		'panel'          => RISING_BAMBOO_KIRKI_PANEL_LAYOUT,
		'priority'       => 9,
	]
);

/**
 * The fields of this section.
 */

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_TITLE_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_TITLE,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Page Title', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_TITLE,
		'label'       => esc_html__('Page Title', 'automize'),
		'description' => esc_html__('Show/Hide the page title.', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_TITLE,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_TITLE),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'color',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_TITLE_COLOR,
		'label'           => esc_html__('Color', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_TITLE,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_TITLE_COLOR),
		'priority'        => $priority++,
		'choices'         => [
			'alpha' => true,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_TITLE,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

/*
 * Breadcrumb.
 */

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_TITLE_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_TITLE,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Breadcrumb', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_BREADCRUMB,
		'label'       => esc_html__('Breadcrumb', 'automize'),
		'description' => esc_html__('Show/hide the breadcrumb.', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_TITLE,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_BREADCRUMB),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'color',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_BREADCRUMB_COLOR,
		'label'           => esc_html__('Breadcrumb Color', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_TITLE,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_BREADCRUMB_COLOR),
		'priority'        => $priority++,
		'choices'         => [
			'alpha' => true,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_BREADCRUMB,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

/**
 * Background.
 */
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_TITLE_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_TITLE,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Background', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_BREADCRUMB_BACKGROUND_COLOR,
		'label'       => esc_html__('Background Color', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_TITLE,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_BREADCRUMB_BACKGROUND_COLOR),
		'priority'    => $priority++,
		'choices'     => [
			'alpha' => true,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'image',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_BREADCRUMB_BACKGROUND_IMAGE,
		'label'    => esc_html__('Background Image', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_TITLE,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_BREADCRUMB_BACKGROUND_IMAGE),
		'priority' => $priority++,
		'choices'  => [
			'save_as' => 'array',
		],
	]
);
