<?php
/**
 * RisingBambooTheme Package
 *
 * @package rising-bamboo
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Customizer\Helper as CustomizerHelper;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;

$priority = 1;

RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
	[
		'title'         => esc_html__('Modal', 'automize'),
		'panel'         => RISING_BAMBOO_KIRKI_PANEL_COMPONENT,
		'description'   => esc_html__('This section contains advanced configurations for "Modal".', 'automize'),
	]
);

/**
 * Scroll to top.
 */

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Modal', 'automize') . '</div>',
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER,
		'label'       => esc_html__('Background Blur', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER),
		'priority'    => $priority++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'slider',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER_SIZE,
		'label'           => esc_html__('Blur Level', 'automize'),
		'description'     => esc_html__('Unit : pixel', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER),
		'priority'        => $priority++,
		'choices'         => [
			'min'  => 5,
			'max'  => 50,
			'step' => 1,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER,
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
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKGROUND_COLOR,
		'label'           => esc_html__('Background Color', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKGROUND_COLOR),
		'priority'        => $priority++,
		'choices'         => [
			'alpha' => true,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER,
				'operator' => '==',
				'value'    => false,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'slider',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKGROUND_OPACITY,
		'label'           => esc_html__('Opacity', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKGROUND_OPACITY),
		'priority'        => $priority++,
		'choices'         => [
			'min'  => 0,
			'max'  => 1,
			'step' => 0.1,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER,
				'operator' => '==',
				'value'    => false,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_EFFECT,
		'label'       => esc_html__('Effect', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_EFFECT),
		'placeholder' => esc_html__('Select an effect...', 'automize'),
		'priority'    => $priority++,
		'choices'     => [
			'none'            => esc_html__('None', 'automize'),
			'slideInOutDown'  => esc_html__('Slide In Out Down', 'automize'),
			'slideInOutTop'   => esc_html__('Slide In Out Top', 'automize'),
			'slideInOutLeft'  => esc_html__('Slide In Out Left', 'automize'),
			'slideInOutRight' => esc_html__('Slide In Out Right', 'automize'),
			'zoomInOut'       => esc_html__('Zoom In Out', 'automize'),
			'rotateInOutDown' => esc_html__('Rotate In Out Down', 'automize'),
			'mixInAnimations' => esc_html__('Mix In Animations', 'automize'),
		],
	] 
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_CLICK_OUTSIDE_CLOSE,
		'label'       => esc_html__('Click outside to close', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_CLICK_OUTSIDE_CLOSE),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_ESC_CLOSE,
		'label'       => esc_html__('"ESC" to close', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_MODAL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_ESC_CLOSE),
		'priority'    => $priority++,
	]
);
