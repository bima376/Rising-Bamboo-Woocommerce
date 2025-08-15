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
	RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
	[
		'title'       => esc_html__('Header', 'automize'),
		'description' => esc_html__('Theme header.', 'automize'),
		'panel'       => RISING_BAMBOO_KIRKI_PANEL_LAYOUT,
		'priority'    => 10,
	]
);

$headers = Helper::get_files_assoc(get_template_directory() . '/template-parts/headers/');
/**
 * The fields of this section.
 */

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Heading', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER,
		'label'       => esc_html__('Template', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER),
		'placeholder' => esc_html__('Select a header...', 'automize'),
		'priority'    => $priority++,
		'multiple'    => 1,
		'choices'     => $headers,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_BACKGROUND_COLOR,
		'label'       => esc_html__('Navigation background color', 'automize'),
		'description' => esc_html__('Background color of the navigation.', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_BACKGROUND_COLOR),
		'priority'    => $priority++,
		'choices'     => [
			'alpha' => true,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_LOGIN_FORM,
		'label'       => esc_html__('Login Form', 'automize'),
		'description' => esc_html__('On/Off login form in header', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_LOGIN_FORM),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_SEARCH_FORM,
		'label'       => esc_html__('Search', 'automize'),
		'description' => esc_html__('On/Off search form in header', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_SEARCH_FORM),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_MINI_CART,
		'label'       => esc_html__('Mini Cart', 'automize'),
		'description' => esc_html__('On/Off mini cart feature in header', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_MINI_CART),
		'priority'    => $priority++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_SEARCH_FORM_MOBILE,
		'label'       => esc_html__('Search Mobile', 'automize'),
		'description' => esc_html__('On/Off search in menu mobile', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_SEARCH_FORM_MOBILE),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_WISH_LIST,
		'label'       => esc_html__('Wish List', 'automize'),
		'description' => esc_html__('On/Off wish list feature in header', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_WISH_LIST),
		'priority'    => $priority++,
	]
);

/**
 * Sticky.
 */

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Heading Sticky', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY,
		'label'       => esc_html__('Enable', 'automize'),
		'description' => esc_html__('On/Off header sticky feature', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'radio',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY_BEHAVIOUR,
		'label'           => esc_html__('Behaviour', 'automize'),
		'description'     => esc_html__('Behaviour of header sticky when you scroll down/up the page', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY_BEHAVIOUR),
		'priority'        => $priority++,
		'choices'         => [
			'both' => [
				esc_html__('Both', 'automize'),
				esc_html__('Sticky on scroll down/up', 'automize'),
			],
			'up' => [
				esc_html__('Scroll Up', 'automize'),
				esc_html__('Sticky on scroll up', 'automize'),
			],
			'down' => [
				esc_html__('Scroll Down', 'automize'),
				esc_html__('Sticky on scroll down', 'automize'),
			],
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'slider',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY_HEIGHT,
		'label'           => esc_html__('Height', 'automize'),
		'description'     => esc_html__('Height of header sticky.', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY_HEIGHT),
		'priority'        => $priority++,
		'choices'         => [
			'min'  => 0,
			'max'  => 300,
			'step' => 1,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'color',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY_BACKGROUND_COLOR,
		'label'           => esc_html__('Background color', 'automize'),
		'description'     => esc_html__('Background color of header sticky.', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY_BACKGROUND_COLOR),
		'priority'        => $priority++,
		'choices'         => [
			'alpha' => true,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);
