<?php
/**
 * RisingBambooTheme Package
 *
 * @package RisingBambooTheme
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Customizer\Helper;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;
use RisingBambooTheme\Customizer\Helper as CustomizerHelper;
$priority = 1;

RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_ADVANCED_MEGA_MENU,
	[
		'title'         => esc_html__('Mega Menu', 'automize'),
		'panel'         => RISING_BAMBOO_KIRKI_PANEL_ADVANCED,
		'description'   => esc_html__('This section contains advanced configurations.', 'automize'),
	]
);

/**
 * General.
 */
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'label'       => esc_html__('Normalize Classes', 'automize'),
		'description' => esc_html__('Remove unnecessary css classes of menu item.', 'automize'),
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_ADVANCED_MEGA_MENU_NORMALIZE_CLASSES,
		'section'     => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_MEGA_MENU,
		'priority'    => $priority++,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_ADVANCED_MEGA_MENU_NORMALIZE_CLASSES),
	]
);

/**
 * 404 Error Page.
 */
RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404,
	[
		'title'         => esc_html__('404 Error Page', 'automize'),
		'panel'         => RISING_BAMBOO_KIRKI_PANEL_ADVANCED,
		'description'   => esc_html__('404 Error Page Configuration.', 'automize'),
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('404 Error Page', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'image',
		'settings'        => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404_IMAGE,
		'label'           => esc_html__('Image', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404_IMAGE),
		'priority'        => $priority++,
		'choices'         => [
			'save_as' => 'url',
		],
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'text',
		'settings'        => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404_TITLE,
		'label'           => esc_html__('Title', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404_TITLE),
		'priority'        => $priority++,
	]
);


RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'text',
		'settings'        => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404_DESC,
		'label'           => esc_html__('Description', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404_DESC),
		'priority'        => $priority++,
	]
);
