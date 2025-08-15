<?php
/**
 * RisingBambooTheme
 *
 * @package RisingBambooTheme
 */

use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;
use RisingBambooTheme\App\App;
use RisingBambooTheme\Customizer\Helper;
use RisingBambooTheme\Customizer\Helper as RisingBambooCustomizerHelper;

$priority = 1;

// <editor-fold desc="Blog Category">
RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_BLOG_CATEGORY,
	[
		'title'       => esc_html__('Blog Category', 'automize'),
		'panel'       => RISING_BAMBOO_KIRKI_PANEL_BLOG,
		'description' => esc_html__('This section contains blog category options.', 'automize'),
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_CATEGORY,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Layout', 'automize') . '</div>',
	]
);

$_layout_category_list = RisingBambooCustomizerHelper::get_files_assoc(get_template_directory() . '/template-parts/contents/layouts/category/');

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_LAYOUT,
		'label'       => esc_html__('Layout', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_BLOG_CATEGORY,
		'default'     => RisingBambooCustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_LAYOUT),
		'placeholder' => esc_html__('Select a layout...', 'automize'),
		'priority'    => $priority++,
		'choices'     => $_layout_category_list,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'number',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_LAYOUT_COLUMNS,
		'label'    => esc_html__('Columns', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_CATEGORY,
		'default'  => RisingBambooCustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_LAYOUT_COLUMNS),
		'choices'  => [
			'min'  => 1,
			'max'  => 3,
			'step' => 1,
		],
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_LAYOUT_SIDEBAR,
		'label'       => esc_html__('Sidebar', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_BLOG_CATEGORY,
		'default'     => RisingBambooCustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_LAYOUT_SIDEBAR),
		'placeholder' => esc_html__('Choose sidebar...', 'automize'),
		'priority'    => $priority++,
		'choices'     => [
			'none'  => 'None',
			'left'  => 'Left',
			'right' => 'Right',
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_CATEGORY,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('General', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_SHOW_AUTHOR,
		'label'    => esc_html__('Show author', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_CATEGORY,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_SHOW_AUTHOR),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_SHOW_PUBLISH_DATE,
		'label'    => esc_html__('Show Publish Date', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_CATEGORY,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_SHOW_PUBLISH_DATE),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_SHOW_EXCERPT,
		'label'    => esc_html__('Show excerpt', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_CATEGORY,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_SHOW_EXCERPT),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_SHOW_COMMENT_COUNT,
		'label'    => esc_html__('Show comment count', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_CATEGORY,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_SHOW_COMMENT_COUNT),
		'priority' => $priority++,
	]
);
// </editor-fold>

// <editor-fold desc="Blog Detail">
RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
	[
		'title'       => esc_html__('Blog Detail', 'automize'),
		'panel'       => RISING_BAMBOO_KIRKI_PANEL_BLOG,
		'description' => esc_html__('This section contains blog detail options.', 'automize'),
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Layout', 'automize') . '</div>',
	]
);

$_layout_list = RisingBambooCustomizerHelper::get_files_assoc(get_template_directory() . '/template-parts/contents/layouts/post');

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_LAYOUT,
		'label'       => esc_html__('Layout', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'     => RisingBambooCustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_LAYOUT),
		'placeholder' => esc_html__('Select a layout...', 'automize'),
		'priority'    => $priority++,
		'choices'     => $_layout_list,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_LAYOUT_SIDEBAR,
		'label'       => esc_html__('Sidebar', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'     => RisingBambooCustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_LAYOUT_SIDEBAR),
		'placeholder' => esc_html__('Choose sidebar...', 'automize'),
		'priority'    => $priority++,
		'choices'     => [
			'none'  => 'None',
			'left'  => 'Left',
			'right' => 'Right',
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_LAYOUT_THUMBNAIL_POSITION,
		'label'       => esc_html__('Feature Image Position', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'     => RisingBambooCustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_LAYOUT_THUMBNAIL_POSITION),
		'placeholder' => esc_html__('Select a position...', 'automize'),
		'priority'    => $priority++,
		'choices'     => [
			'none'         => 'Hide',
			'before_title' => 'Before Title',
			'after_title'  => 'After Title',
			'on_top'       => 'On Top',
			'on_header'    => 'On Header',
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('General', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_SHOW_AUTHOR,
		'label'    => esc_html__('Show Author', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_SHOW_AUTHOR),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_SHOW_PUBLISH_DATE,
		'label'    => esc_html__('Show Publish Date', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_SHOW_PUBLISH_DATE),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_SHOW_CATEGORY,
		'label'    => esc_html__('Show Category', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_SHOW_CATEGORY),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_SHOW_TAG,
		'label'    => esc_html__('Show Tag', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_SHOW_TAG),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_SHOW_COMMENT,
		'label'    => esc_html__('Show Comment', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_SHOW_COMMENT),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_SHOW_COMMENT_FORM,
		'label'    => esc_html__('Show Comment Form', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_SHOW_COMMENT_FORM),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_SHOW_SOCIAL_SHARE,
		'label'    => esc_html__('Show Social Share', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_DETAIL_SHOW_SOCIAL_SHARE),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Related Posts', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_SHOW,
		'label'    => esc_html__('Show Related Posts', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_SHOW),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_SHOW_NAVIGATION,
		'label'    => esc_html__('Show Navigation', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_SHOW_NAVIGATION),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_SHOW_PAGINATION,
		'label'    => esc_html__('Show Pagination', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_SHOW_PAGINATION),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'toggle',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_AUTO_PLAY,
		'label'    => esc_html__('Auto Play', 'automize'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_AUTO_PLAY),
		'priority' => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'number',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_AUTO_PLAY_SPEED,
		'label'           => esc_html__('Auto Play Speed', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_BLOG_DETAIL,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_AUTO_PLAY_SPEED),
		'priority'        => $priority++,
		'choices'         => [
			'min'  => 1000,
			'max'  => 1500,
			'step' => 100,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_AUTO_PLAY,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

// </editor-fold>
