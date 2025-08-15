<?php
/**
 * List Sidebars.
 *
 * @package Rising_Bamboo
 */

use RisingBambooTheme\App\App;

return [
	[
		'name'          => esc_html__('Top Bar', 'automize'),
		'id'            => 'sidebar-top',
		'class'         => 'sidebar-top',
		'description'   => esc_html__('Add widgets here.', 'automize'),
		'before_widget' => '<div id="%1$s" class="sidebar-top-content %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title sidebar-top-title">',
		'after_title'   => '</h5>',
	],
	[
		'name'          => esc_html__('Sidebar Blog Top', 'automize'),
		'id'            => 'sidebar-blog-top',
		'class'         => 'sidebar-blog-top',
		'description'   => esc_html__('Add widgets here.', 'automize'),
		'before_widget' => '<div id="%1$s" class="sidebar-blog-top-content %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title sidebar-blog-top-title"><i class="rbb-icon-menu-1 pr-5"></i>',
		'after_title'   => '</h5>',
	],
	[
		'name'          => esc_html__('Sidebar Blog', 'automize'),
		'id'            => 'sidebar-blog',
		'class'         => 'sidebar-blog',
		'description'   => esc_html__('Add widgets here.', 'automize'),
		'before_widget' => '<div id="%1$s" class="sidebar-blog-content %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title sidebar-blog-title">',
		'after_title'   => '</h5>',
	],
	[
		'name'          => esc_html__('Sidebar Shop Filter', 'automize'),
		'id'            => 'sidebar-shop-filter',
		'class'         => 'sidebar-shop-filter',
		'description'   => esc_html__('Add shop filter widgets here.', 'automize'),
		'before_widget' => '<div id="%1$s" class="sidebar-shop-filter-widget %2$s"><div class="sidebar-shop-filter-group">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h5 class="widget-title sidebar-shop-filter-title cursor-pointer pb-[15px]">',
		'after_title'   => '<i class="rbb-icon-direction-42 float-right text-[10px] text-[#222] leading-[23px] font-bold"></i></h5>',
	],
	[
		'name'          => esc_html__('Product Category Bottom', 'automize'),
		'id'            => 'product-category-bottom',
		'class'         => 'product-category-bottom',
		'description'   => esc_html__('Add widgets here.', 'automize'),
		'before_widget' => '<div id="%1$s" class="category-bottom-widget %2$s"><div class="container mx-auto overflow-hidden">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h5 class="widget-title sidebar-category-bottom mb-7">',
		'after_title'   => '</h5>',
	],
	[
		'name'          => esc_html__('Header 3 Top', 'automize'),
		'id'            => 'sidebar-header3-top',
		'class'         => 'sidebar-header3-top',
		'description'   => esc_html__('Add widgets here.', 'automize'),
		'before_widget' => '<div id="%1$s" class="sidebar-header3-top-content %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title sidebar-header3-top-title">',
		'after_title'   => '</h5>',
	],
	[
		'name'          => esc_html__('Header 11 Top', 'automize'),
		'id'            => 'sidebar-header11-top',
		'class'         => 'sidebar-header11-top',
		'description'   => esc_html__('Add widgets here.', 'automize'),
		'before_widget' => '<div id="%1$s" class="sidebar-header11-top-content %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widget-title sidebar-header11-top-title">',
		'after_title'   => '</h5>',
	],
];
