<?php
/**
 * RisingBambooTheme Package
 *
 * @package RisingBambooTheme
 * @version 1.0.0
 * @since 1.0.0
 */

use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;
use RisingBambooTheme\App\App;
use RisingBambooTheme\Customizer\Helper as CustomizerHelper;

$priority = 1;

RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
	[
		'title'       => esc_html__('Promotion Popup', 'automize'),
		'panel'       => RISING_BAMBOO_KIRKI_PANEL_COMPONENT,
		'description' => esc_html__('This section contains configurations for Promotion Popup.', 'automize'),
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Promotion Popup', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_ENABLE,
		'label'    => esc_html__('Enable', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
		'default'  => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_ENABLE),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'select',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_TYPE,
		'label'           => esc_html__('Type', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_TYPE),
		'placeholder'     => esc_html__('Select type...', 'automize'),
		'priority'        => $priority++,
		'choices'         => [
			'promotion'  => esc_html__('Promotion', 'automize'),
			'newsletter' => esc_html__('Newsletter', 'automize'),
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_ENABLE,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

// <editor-fold desc="Newsletter">
$contact_form = RisingBambooTheme\Helper\Helper::get_contact_form_7_list();
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'select',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_NEWSLETTER_FORM,
		'label'           => esc_html__('Form', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_NEWSLETTER_FORM),
		'placeholder'     => esc_html__('Select form...', 'automize'),
		'priority'        => $priority++,
		'choices'         => $contact_form,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_TYPE,
				'operator' => '==',
				'value'    => 'newsletter',
			],
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_ENABLE,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'image',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_NEWSLETTER_IMAGE,
		'label'           => esc_html__('Newsletter Image', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_NEWSLETTER_IMAGE),
		'priority'        => $priority++,
		'choices'         => [
			'save_as' => 'array',
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_ENABLE,
				'operator' => '==',
				'value'    => true,
			],
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_TYPE,
				'operator' => '==',
				'value'    => 'newsletter',
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'text',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_TITLE,
		'label'           => esc_html__('Title', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_TITLE),
		'priority'        => $priority++,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_ENABLE,
				'operator' => '==',
				'value'    => true,
			],
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_TYPE,
				'operator' => '==',
				'value'    => 'newsletter',
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'text',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_SUB_TITLE,
		'label'           => esc_html__('Sub Title', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_SUB_TITLE),
		'priority'        => $priority++,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_ENABLE,
				'operator' => '==',
				'value'    => true,
			],
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_TYPE,
				'operator' => '==',
				'value'    => 'newsletter',
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'text',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_DESC,
		'label'           => esc_html__('Description', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_DESC),
		'priority'        => $priority++,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_ENABLE,
				'operator' => '==',
				'value'    => true,
			],
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_TYPE,
				'operator' => '==',
				'value'    => 'newsletter',
			],
		],
	]
);

// </editor-fold>

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'link',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_LINK,
		'label'           => esc_html__('Link', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
		'default'         => '#',
		'priority'        => $priority++,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_TYPE,
				'operator' => '==',
				'value'    => 'promotion',
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'image',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_IMAGE,
		'label'           => esc_html__('Promotion Image', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_IMAGE),
		'priority'        => $priority++,
		'choices'         => [
			'save_as' => 'array',
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_ENABLE,
				'operator' => '==',
				'value'    => true,
			],
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_TYPE,
				'operator' => '==',
				'value'    => 'promotion',
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'number',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_DELAY,
		'label'           => esc_html__('Delay to show', 'automize'),
		'description'     => esc_html__('Popup will be show after a number of milliseconds.', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_DELAY),
		'priority'        => $priority++,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_ENABLE,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'number',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_REPEAT,
		'label'           => esc_html__('Repeat', 'automize'),
		'description'     => esc_html__('Popup will be show again after a number of minutes.', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_REPEAT),
		'priority'        => $priority++,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_ENABLE,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'toggle',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_DONT_SHOW_AGAIN,
		'label'           => esc_html__('Don\'t show again', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_DONT_SHOW_AGAIN),
		'priority'        => $priority++,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_ENABLE,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'number',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_DONT_SHOW_AGAIN_EXPIRED,
		'label'           => esc_html__('Don\'t show again expried', 'automize'),
		'description'     => esc_html__('Set a number of minutes', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_PROMOTION_POPUP,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_DONT_SHOW_AGAIN_EXPIRED),
		'priority'        => $priority++,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_ENABLE,
				'operator' => '==',
				'value'    => true,
			],
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_PROMOTION_POPUP_DONT_SHOW_AGAIN,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);
