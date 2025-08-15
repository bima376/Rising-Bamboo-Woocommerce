<?php
/**
 * The Customizer Panel
 *
 * @package Rising_Bamboo
 */

use RisingBambooTheme\App\App;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;

/**
 * General.
 */
RisingBambooKirki::add_panel(
	RISING_BAMBOO_KIRKI_PANEL_GENERAL,
	[
		'priority'    => 10,
		'title'       => esc_html__('General', 'automize'),
		'description' => esc_html__('General theme settings', 'automize'),
	] 
);

/**
 * Layout.
 */
RisingBambooKirki::add_panel(
	RISING_BAMBOO_KIRKI_PANEL_LAYOUT,
	[
		'priority'    => 11,
		'title'       => esc_html__('Layout', 'automize'),
		'description' => esc_html__('The layout configuration', 'automize'),
	]
);

/**
 * Components.
 */
RisingBambooKirki::add_panel(
	RISING_BAMBOO_KIRKI_PANEL_COMPONENT,
	[
		'priority'    => 12,
		'title'       => esc_html__('Components', 'automize'),
		'description' => esc_html__('Other components', 'automize'),
	]
);

/**
 * Advanced.
 */
RisingBambooKirki::add_panel(
	RISING_BAMBOO_KIRKI_PANEL_ADVANCED,
	[
		'priority'    => 13,
		'title'       => esc_html__('Advanced', 'automize'),
		'description' => esc_html__('Advanced Configuration', 'automize'),
	]
);

/**
 * Blog.
 */
RisingBambooKirki::add_panel(
	RISING_BAMBOO_KIRKI_PANEL_BLOG,
	[
		'priority'    => 14,
		'title'       => esc_html__('Blog', 'automize'),
		'description' => esc_html__('Blog Configuration', 'automize'),
	]
);


