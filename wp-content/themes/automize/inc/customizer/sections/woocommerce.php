<?php
/**
 * RisingBambooTheme Package.
 *
 * @package RisingBambooTheme
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Customizer\Helper as CustomizerHelper;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;
use RisingBambooTheme\Helper\Helper;
use RisingBambooCore\Helper\Helper as RisingBambooCoreHelper;

// <editor-fold desc="Account Navigation">
$priority_account = 1;
RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_ACCOUNT,
	[
		'title'          => esc_html__('Account', 'automize'),
		'description'    => esc_html__('Account Page Settings', 'automize'),
		'panel'          => 'woocommerce',
		'priority'       => 1,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_ACCOUNT_GROUP_TITLE . '_' . ( $priority_account++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_ACCOUNT,
		'priority' => $priority_account++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Account Navigation', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'rbb-icons',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_ACCOUNT_DASHBOARD_ICON,
		'label'       => esc_html__('Dashboard Icon', 'automize'),
		'description' => esc_html__('Choose the dashboard icon ?', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_ACCOUNT,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_ACCOUNT_DASHBOARD_ICON),
		'priority'    => $priority_account++,
		'choices'     => Helper::get_rbb_icons([ 'dashboard', 'settings' ]),
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'rbb-icons',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_ACCOUNT_ORDERS_ICON,
		'label'       => esc_html__('Orders Icon', 'automize'),
		'description' => esc_html__('Choose the orders icon ?', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_ACCOUNT,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_ACCOUNT_ORDERS_ICON),
		'priority'    => $priority_account++,
		'choices'     => Helper::get_rbb_icons('shopping'),
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'rbb-icons',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_ACCOUNT_DOWNLOADS_ICON,
		'label'       => esc_html__('Downloads Icon', 'automize'),
		'description' => esc_html__('Choose the downloads icon ?', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_ACCOUNT,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_ACCOUNT_DOWNLOADS_ICON),
		'priority'    => $priority_account++,
		'choices'     => Helper::get_rbb_icons('download'),
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'rbb-icons',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_ACCOUNT_ADDRESS_ICON,
		'label'       => esc_html__('Addresses Icon', 'automize'),
		'description' => esc_html__('Choose the addresses icon ?', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_ACCOUNT,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_ACCOUNT_ADDRESS_ICON),
		'priority'    => $priority_account++,
		'choices'     => Helper::get_rbb_icons('home'),
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'rbb-icons',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_ACCOUNT_DETAIL_ICON,
		'label'       => esc_html__('Details Icon', 'automize'),
		'description' => esc_html__('Choose the details icon ?', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_ACCOUNT,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_ACCOUNT_DETAIL_ICON),
		'priority'    => $priority_account++,
		'choices'     => Helper::get_rbb_icons('human'),
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'rbb-icons',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_ACCOUNT_LOGOUT_ICON,
		'label'       => esc_html__('Logout Icon', 'automize'),
		'description' => esc_html__('Choose the logout icon ?', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_ACCOUNT,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_ACCOUNT_LOGOUT_ICON),
		'priority'    => $priority_account++,
		'choices'     => Helper::get_rbb_icons('account'),
	]
);
// </editor-fold>

// <editor-fold desc="Cart">
$priority_cart = 1;
RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
	[
		'title'          => esc_html__('Cart', 'automize'),
		'description'    => esc_html__('Cart & Mini Cart Settings.', 'automize'),
		'panel'          => 'woocommerce',
		'priority'       => 1,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_CART_GROUP_TITLE . '_' . ( $priority_cart++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'priority' => $priority_cart++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Cart', 'automize') . '</div>',
	]
);

// <editor-fold desc="Mini Cart Icon">
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_CART_GROUP_TITLE . '_' . ( $priority_cart++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'priority' => $priority_cart++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Mini Cart', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_LAYOUT,
		'label'       => esc_html__('Layout', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_LAYOUT),
		'priority'    => $priority_cart++,
		'placeholder' => esc_html__('Select a layout...', 'automize'),
		'choices'     => [
			'dropdown'    => esc_html__('Dropdown', 'automize'),
			'canvas'      => esc_html__('Canvas', 'automize'),
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'rbb-icons',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON,
		'label'       => esc_html__('Cart Icon', 'automize'),
		'description' => esc_html__('Choose the mini cart icon ?', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON),
		'priority'    => $priority_cart++,
		'choices'     => Helper::get_rbb_icons('shopping'),
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'slider',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON_SIZE,
		'label'       => esc_html__('Cart Size', 'automize'),
		'description' => esc_html__('Unit : Pixel', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON_SIZE),
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
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON_COLOR,
		'label'       => esc_html__('Cart Icon Color', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON_COLOR),
		'choices'     => [
			'alpha' => true,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'slider',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON_BORDER,
		'label'       => esc_html__('Cart Icon Border', 'automize'),
		'description' => esc_html__('Unit : Pixel', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON_BORDER),
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
		'type'            => 'dimension',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON_BORDER_RADIUS,
		'label'           => esc_html__('Cart Icon Border Radius', 'automize'),
		'description'     => __('Control <a target="_blank" href="https://developer.mozilla.org/en-US/docs/Web/CSS/border-radius"> border radius </a>.', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON_BORDER_RADIUS),
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON_BORDER,
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
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON_BORDER_COLOR,
		'label'           => esc_html__('Cart Icon Border Color', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON_BORDER_COLOR),
		'choices'         => [
			'alpha' => true,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON_BORDER,
				'operator' => '!==',
				'value'    => '0',
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_COUNT_COLOR,
		'label'       => esc_html__('Counting Text Color', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_COUNT_COLOR),
		'choices'     => [
			'alpha' => true,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_COUNT_BACKGROUND_COLOR,
		'label'       => esc_html__('Counting Background', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_COUNT_BACKGROUND_COLOR),
		'choices'     => [
			'alpha' => true,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'dimensions',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_COUNT_POSITION,
		'label'       => esc_html__('Counting Position', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_COUNT_POSITION),
	]
);
// </editor-fold>

// <editor-fold desc="Mini Cart Content">
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_CONTENT_BACKGROUND_COLOR,
		'label'       => esc_html__('Cart Content Background', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_CONTENT_BACKGROUND_COLOR),
		'choices'     => [
			'alpha' => true,
		],
		'priority'    => $priority_cart++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'slider',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_CONTENT_BORDER,
		'label'       => esc_html__('Cart Content Border', 'automize'),
		'description' => esc_html__('Unit : Pixel', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_CONTENT_BORDER),
		'choices'     => [
			'min'  => 0,
			'max'  => 5,
			'step' => 0.5,
		],
		'priority'    => $priority_cart++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'color',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_CONTENT_BORDER_COLOR,
		'label'           => esc_html__('Cart Content Border Color', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_CONTENT_BORDER_COLOR),
		'choices'         => [
			'alpha' => true,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_CONTENT_BORDER,
				'operator' => '!==',
				'value'    => '0',
			],
		],
		'priority'        => $priority_cart++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'slider',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_PRODUCT_IMAGE_SIZE,
		'label'       => esc_html__('Product Image Size', 'automize'),
		'description' => esc_html__('Unit : Pixel', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_PRODUCT_IMAGE_SIZE),
		'choices'     => [
			'min'  => 10,
			'max'  => 300,
			'step' => 1,
		],
		'priority'    => $priority_cart++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'slider',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_REMOVE_BUTTON_SIZE,
		'label'       => esc_html__('Remove Button Size', 'automize'),
		'description' => esc_html__('Unit : Pixel', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_REMOVE_BUTTON_SIZE),
		'choices'     => [
			'min'  => 10,
			'max'  => 50,
			'step' => 1,
		],
		'priority'    => $priority_cart++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_REMOVE_BUTTON_COLOR,
		'label'       => esc_html__('Remove Button Text Color', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_REMOVE_BUTTON_COLOR),
		'choices'     => [
			'alpha' => true,
		],
		'priority'    => $priority_cart++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_REMOVE_BUTTON_BACKGROUND_COLOR,
		'label'       => esc_html__('Remove Button Background', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_REMOVE_BUTTON_BACKGROUND_COLOR),
		'choices'     => [
			'alpha' => true,
		],
		'priority'    => $priority_cart++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'slider',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_REMOVE_BUTTON_BORDER,
		'label'       => esc_html__('Remove Button Border', 'automize'),
		'description' => esc_html__('Unit : Pixel', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_REMOVE_BUTTON_BORDER),
		'choices'     => [
			'min'  => 0,
			'max'  => 5,
			'step' => 0.5,
		],
		'priority'    => $priority_cart++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'color',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_REMOVE_BUTTON_BORDER_COLOR,
		'label'           => esc_html__('Remove Button Border Color', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_REMOVE_BUTTON_BORDER_COLOR),
		'choices'         => [
			'alpha' => true,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_REMOVE_BUTTON_BORDER,
				'operator' => '!==',
				'value'    => '0',
			],
		],
		'priority'        => $priority_cart++,
	]
);
// </editor-fold>

// <editor-fold desc="Cross-sells">

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_CART_GROUP_TITLE . '_' . ( $priority_cart++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'priority' => $priority_cart++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Cross-sells', 'automize') . '</div>',
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_CROSSS_SELLS_STATUS,
		'label'       => esc_html__('Enable', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_CROSSS_SELLS_STATUS),
		'priority'    => $priority_cart++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'number',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_CROSSS_SELLS_PER_PAGE,
		'label'       => esc_html__('Post per page', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_CROSSS_SELLS_PER_PAGE),
		'priority'    => $priority_cart++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'number',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_CROSSS_SELLS_COLS,
		'label'       => esc_html__('Column', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_CROSSS_SELLS_COLS),
		'priority'    => $priority_cart++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_CROSSS_SELLS_ORDER_BY,
		'label'       => esc_html__('Order By', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_CROSSS_SELLS_ORDER_BY),
		'priority'    => $priority_cart++,
		'placeholder' => esc_html__('Select condition...', 'automize'),
		'choices'     => [
			'rand'       => esc_html__('Random', 'automize'),
			'title'      => esc_html__('Title', 'automize'),
			'id'         => esc_html__('ID', 'automize'),
			'date'       => esc_html__('Date', 'automize'),
			'modified'   => esc_html__('Modified', 'automize'),
			'menu_order' => esc_html__('Menu order', 'automize'),
			'price'      => esc_html__('Price', 'automize'),
			'none'       => esc_html__('None', 'automize'),
		],
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_CROSSS_SELLS_ORDER,
		'label'       => esc_html__('Order', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_CART,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_CROSSS_SELLS_ORDER),
		'priority'    => $priority_cart++,
		'placeholder' => esc_html__('Select order...', 'automize'),
		'choices'     => [
			'asc'  => esc_html__('Ascending', 'automize'),
			'desc' => esc_html__('Descending', 'automize'),
		],
	]
);
// </editor-fold>

// </editor-fold>

// <editor-fold desc="WishList">
$priority_wishlist = 1;
if ( RisingBambooCoreHelper::woocommerce_wishlist_activated() ) {

	RisingBambooKirki::add_section(
		RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_WISHLIST,
		[
			'title'          => esc_html__('Wishlist', 'automize'),
			'description'    => esc_html__('Wishlist Settings.', 'automize'),
			'panel'          => 'woocommerce',
			'priority'       => 2,
		]
	);

	RisingBambooKirki::add_field(
		RISING_BAMBOO_KIRKI_CONFIG,
		[
			'type'     => 'custom',
			'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_GROUP_TITLE . '_' . ( $priority_wishlist++ ),
			'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_WISHLIST,
			'priority' => $priority_wishlist++,
			'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Wishlist', 'automize') . '<small>' . esc_html__('in header', 'automize') . '</small></div>',
		]
	);

	RisingBambooKirki::add_field(
		RISING_BAMBOO_KIRKI_CONFIG,
		[
			'type'        => 'rbb-icons',
			'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON,
			'label'       => esc_html__('Wishlist Icon', 'automize'),
			'description' => esc_html__('Choose the wish list icon ?', 'automize'),
			'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_WISHLIST,
			'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON),
			'priority'    => $priority_wishlist++,
			'choices'     => Helper::get_rbb_icons('wishlist'),
		]
	);

	RisingBambooKirki::add_field(
		RISING_BAMBOO_KIRKI_CONFIG,
		[
			'type'        => 'slider',
			'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON_SIZE,
			'label'       => esc_html__('Wish List Icon Size', 'automize'),
			'description' => esc_html__('Unit : Pixel', 'automize'),
			'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_WISHLIST,
			'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON_SIZE),
			'priority'    => $priority_wishlist++,
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
			'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON_COLOR,
			'label'       => esc_html__('Wish List Icon Color', 'automize'),
			'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_WISHLIST,
			'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON_COLOR),
			'priority'    => $priority_wishlist++,
			'choices'     => [
				'alpha' => true,
			],
		]
	);

	RisingBambooKirki::add_field(
		RISING_BAMBOO_KIRKI_CONFIG,
		[
			'type'        => 'slider',
			'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON_BORDER,
			'label'       => esc_html__('Wishlist Icon Border', 'automize'),
			'description' => esc_html__('Unit : Pixel', 'automize'),
			'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_WISHLIST,
			'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON_BORDER),
			'priority'    => $priority_wishlist++,
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
			'type'            => 'dimension',
			'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON_BORDER_RADIUS,
			'label'           => esc_html__('Wishlist Icon Border Radius', 'automize'),
			'description'     => __('Control <a target="_blank" href="https://developer.mozilla.org/en-US/docs/Web/CSS/border-radius"> border radius</a>.', 'automize'),
			'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_WISHLIST,
			'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON_BORDER_RADIUS),
			'priority'        => $priority_wishlist++,
			'active_callback' => [
				[
					'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON_BORDER,
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
			'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON_BORDER_COLOR,
			'label'           => esc_html__('Wishlist Icon Border Color', 'automize'),
			'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_WISHLIST,
			'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON_BORDER_COLOR),
			'priority'        => $priority_wishlist++,
			'choices'         => [
				'alpha' => true,
			],
			'active_callback' => [
				[
					'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON_BORDER,
					'operator' => '!==',
					'value'    => '0',
				],
			],
		]
	);

	RisingBambooKirki::add_field(
		RISING_BAMBOO_KIRKI_CONFIG,
		[
			'type'        => 'color',
			'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_COUNT_COLOR,
			'label'       => esc_html__('Counting Text Color', 'automize'),
			'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_WISHLIST,
			'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_COUNT_COLOR),
			'priority'    => $priority_wishlist++,
			'choices'     => [
				'alpha' => true,
			],
		]
	);

	RisingBambooKirki::add_field(
		RISING_BAMBOO_KIRKI_CONFIG,
		[
			'type'        => 'color',
			'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_COUNT_BACKGROUND,
			'label'       => esc_html__('Counting Background', 'automize'),
			'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_WISHLIST,
			'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_COUNT_BACKGROUND),
			'priority'    => $priority_wishlist++,
			'choices'     => [
				'alpha' => true,
			],
		]
	);

	RisingBambooKirki::add_field(
		RISING_BAMBOO_KIRKI_CONFIG,
		[
			'type'        => 'dimensions',
			'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_COUNT_POSITION,
			'label'       => esc_html__('Counting Position', 'automize'),
			'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_WISHLIST,
			'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_COUNT_POSITION),
			'priority'    => $priority_wishlist++,
		]
	);

	RisingBambooKirki::add_field(
		RISING_BAMBOO_KIRKI_CONFIG,
		[
			'type'     => 'custom',
			'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_GROUP_TITLE . '_' . ( $priority_wishlist++ ),
			'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_WISHLIST,
			'priority' => $priority_wishlist++,
			'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('General Wishlist', 'automize') . '</div>',
		]
	);

	RisingBambooKirki::add_field(
		RISING_BAMBOO_KIRKI_CONFIG,
		[
			'type'        => 'rbb-icons',
			'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_GENERAL_ICON,
			'label'       => esc_html__('Wishlist Icon', 'automize'),
			'description' => esc_html__('Choose the wishlist general icon ?', 'automize'),
			'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_WISHLIST,
			'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_GENERAL_ICON),
			'priority'    => $priority_wishlist++,
			'choices'     => Helper::get_rbb_icons('wishlist'),
		]
	);
}
// </editor-fold>

// <editor-fold desc="Compare">
$priority_compare = 1;
if ( RisingBambooCoreHelper::woocommerce_compare_activated() ) {

	RisingBambooKirki::add_section(
		RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_COMPARE,
		[
			'title'          => esc_html__('Compare', 'automize'),
			'description'    => esc_html__('Compare Settings.', 'automize'),
			'panel'          => 'woocommerce',
			'priority'       => 3,
		]
	);

	RisingBambooKirki::add_field(
		RISING_BAMBOO_KIRKI_CONFIG,
		[
			'type'     => 'custom',
			'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_COMPARE_GROUP_TITLE . '_' . ( $priority_compare++ ),
			'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_COMPARE,
			'priority' => $priority_compare++,
			'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('General Compare', 'automize') . '</div>',
		]
	);

	RisingBambooKirki::add_field(
		RISING_BAMBOO_KIRKI_CONFIG,
		[
			'type'        => 'rbb-icons',
			'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_COMPARE_GENERAL_ICON,
			'label'       => esc_html__('Compare Icon', 'automize'),
			'description' => esc_html__('Choose the wish list icon ?', 'automize'),
			'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_COMPARE,
			'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_COMPARE_GENERAL_ICON),
			'priority'    => $priority_compare++,
			'choices'     => Helper::get_rbb_icons('compare'),
		]
	);

	RisingBambooKirki::add_field(
		RISING_BAMBOO_KIRKI_CONFIG,
		[
			'type'        => 'slider',
			'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_COMPARE_GENERAL_ICON_SIZE,
			'label'       => esc_html__('Compare Icon Size', 'automize'),
			'description' => esc_html__('Unit : Pixel', 'automize'),
			'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_COMPARE,
			'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_COMPARE_GENERAL_ICON_SIZE),
			'priority'    => $priority_compare++,
			'choices'     => [
				'min'  => 10,
				'max'  => 100,
				'step' => 1,
			],
		]
	);
}
// </editor-fold>

// <editor-fold desc="Quick View">
$priority_quick_view = 1;
RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_QUICK_VIEW,
	[
		'title'          => esc_html__('Quick View', 'automize'),
		'description'    => esc_html__('Quick View Settings.', 'automize'),
		'panel'          => 'woocommerce',
		'priority'       => 3,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_QUICK_VIEW_GROUP_TITLE . '_' . ( $priority_quick_view++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_QUICK_VIEW,
		'priority' => $priority_quick_view++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Quick View', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_QUICK_VIEW_STATUS,
		'label'       => esc_html__('Enable', 'automize'),
		'description' => esc_html__('Enable/Disable the quick view ?', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_QUICK_VIEW,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_QUICK_VIEW_STATUS),
		'priority'    => $priority_quick_view++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'rbb-icons',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_QUICK_VIEW_ICON,
		'label'       => esc_html__('Icon', 'automize'),
		'description' => esc_html__('Choose the icon ?', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_QUICK_VIEW,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_QUICK_VIEW_ICON),
		'priority'    => $priority_quick_view++,
		'choices'     => Helper::get_rbb_icons([ 'quickview' ]),
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'slider',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_QUICK_VIEW_ICON_SIZE,
		'label'       => esc_html__('Quick View Icon Size', 'automize'),
		'description' => esc_html__('Unit : Pixel', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_QUICK_VIEW,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_QUICK_VIEW_ICON_SIZE),
		'priority'    => $priority_quick_view++,
		'choices'     => [
			'min'  => 10,
			'max'  => 100,
			'step' => 1,
		],
	]
);
// </editor-fold>

// <editor-fold desc="Product Detail">
$priority_product_detail = 1;
RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
	[
		'title'          => esc_html__('Product Detail', 'automize'),
		'description'    => esc_html__('Product Detail Settings.', 'automize'),
		'panel'          => 'woocommerce',
		'priority'       => 7,
	]
);
// <editor-fold desc="Product Detail Image">
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_GROUP_TITLE . '_' . ( $priority_product_detail++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'priority' => $priority_product_detail,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Images', 'automize') . '</div>',
	]
);

$product_detail_image_layout = RisingBambooCoreHelper::get_files_assoc(get_template_directory() . '/woocommerce/single-product/image-layout/');

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_IMAGE_LAYOUT,
		'label'       => esc_html__('Image layout', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL),
		'placeholder' => esc_html__('Select a image layout...', 'automize'),
		'priority'    => $priority_product_detail++,
		'multiple'    => 1,
		'choices'     => $product_detail_image_layout,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'select',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_IMAGE_THUMBNAIL_POSITION,
		'label'           => esc_html__('Thumbnail Position', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_IMAGE_THUMBNAIL_POSITION),
		'placeholder'     => esc_html__('Select position...', 'automize'),
		'priority'        => $priority_product_detail++,
		'multiple'        => 1,
		'choices'         => [
			'top'    => 'Top',
			'bottom' => 'Bottom',
			'left'   => 'Left',
			'right'  => 'Right',
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_IMAGE_LAYOUT,
				'operator' => '==',
				'value'    => 'default',
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'select',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_IMAGE_SCROLL_THUMBNAIL_POSITION,
		'label'           => esc_html__('Thumbnail Position', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_IMAGE_SCROLL_THUMBNAIL_POSITION),
		'placeholder'     => esc_html__('Select position...', 'automize'),
		'priority'        => $priority_product_detail++,
		'multiple'        => 1,
		'choices'         => [
			'left'   => 'Left',
			'right'  => 'Right',
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_IMAGE_LAYOUT,
				'operator' => '==',
				'value'    => 'scroll',
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'number',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_IMAGE_THUMBNAIL_NUMBER,
		'label'           => esc_html__('Thumbnail Images', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_IMAGE_THUMBNAIL_NUMBER),
		'priority'        => $priority_product_detail++,
		'choices'         => [
			'min'  => 1,
			'max'  => 10,
			'step' => 1,
		],
		'active_callback' => [
			[
				[
					'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_IMAGE_LAYOUT,
					'operator' => '==',
					'value'    => 'default',
				],
				[
					'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_IMAGE_LAYOUT,
					'operator' => '==',
					'value'    => 'scroll',
				],
			],
		],
	]
);
// </editor-fold>
// <editor-fold desc="Product Detail Summary">
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_GROUP_TITLE . '_' . ( $priority_product_detail++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'priority' => $priority_product_detail,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Summary', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'toggle',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_SHOW_EXCERPT,
		'label'           => esc_html__('Show Product Excerpt', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_SHOW_EXCERPT),
		'priority'        => $priority_product_detail++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'toggle',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_SHOW_SKU,
		'label'           => esc_html__('Show Product SKU', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_SHOW_SKU),
		'priority'        => $priority_product_detail++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'toggle',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_SHOW_CATEGORY,
		'label'           => esc_html__('Show Product Category', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_SHOW_CATEGORY),
		'priority'        => $priority_product_detail++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'toggle',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_SHOW_TAG,
		'label'           => esc_html__('Show Product Tag', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_SHOW_TAG),
		'priority'        => $priority_product_detail++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'toggle',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_SHOW_SHARING,
		'label'           => esc_html__('Show Sharing', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_SHOW_SHARING),
		'priority'        => $priority_product_detail++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'toggle',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_SHOW_GUARANTEE_CHECKOUT,
		'label'           => esc_html__('Show Guarantee', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_SHOW_GUARANTEE_CHECKOUT),
		'priority'        => $priority_product_detail++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'text',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_GUARANTEE_CHECKOUT_TEXT,
		'label'           => esc_html__('Guarantee Text', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_GUARANTEE_CHECKOUT_TEXT),
		'priority'        => $priority_product_detail++,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_SHOW_GUARANTEE_CHECKOUT,
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
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_GUARANTEE_CHECKOUT,
		'label'           => esc_html__('Guarantee Image', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_GUARANTEE_CHECKOUT),
		'priority'        => $priority_product_detail++,
		'choices'         => [
			'save_as' => 'array',
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_SHOW_GUARANTEE_CHECKOUT,
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
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_CONTACT_SHOW,
		'label'           => esc_html__('Contact Form', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_CONTACT_SHOW),
		'priority'        => $priority_product_detail++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'text',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_CONTACT_TEXT,
		'label'           => esc_html__('Contact Form Text', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_CONTACT_TEXT),
		'priority'        => $priority_product_detail++,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_CONTACT_SHOW,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

$contact_form = Helper::get_contact_form_7_list();

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'select',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_CONTACT_FORM,
		'label'           => esc_html__('Contact Form', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_CONTACT_FORM),
		'priority'        => $priority_product_detail++,
		'placeholder'     => esc_html__('Select Contact Form...', 'automize'),
		'choices'         => $contact_form,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_SUMMARY_CONTACT_SHOW,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

// </editor-fold>

// <editor-fold desc="Product Data">
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_GROUP_TITLE . '_' . ( $priority_product_detail++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'priority' => $priority_product_detail,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Data', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_DATA_LAYOUT,
		'label'       => esc_html__('Layout', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_DATA_LAYOUT),
		'priority'    => $priority_product_detail++,
		'placeholder' => esc_html__('Select a layout...', 'automize'),
		'choices'     => [
			'tab'       => 'Tab',
			'accordion' => 'Accordion',
		],
	]
);
// </editor-fold>

// <editor-fold desc="Related Product & Up-Sell Product">
// <editor-fold desc="Related & Up-sell Layout">
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_GROUP_TITLE . '_' . ( $priority_product_detail++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'priority' => $priority_product_detail++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Related & Upsell Layout', 'automize') . '</div>',
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_RELATED_UP_CROSS_SELLS_LAYOUT,
		'label'       => esc_html__('Layout', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_RELATED_UP_CROSS_SELLS_LAYOUT),
		'priority'    => $priority_product_detail++,
		'placeholder' => esc_html__('Select layout...', 'automize'),
		'choices'     => [
			'tabs' => esc_html__('Tabs', 'automize'),
			'list' => esc_html__('List', 'automize'),
		],
	]
);
// </editor-fold>

// <editor-fold desc="Related Product">
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_GROUP_TITLE . '_' . ( $priority_product_detail++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'priority' => $priority_product_detail++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Related Products', 'automize') . '</div>',
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_RELATED_STATUS,
		'label'       => esc_html__('Enable', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_RELATED_STATUS),
		'priority'    => $priority_product_detail++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'number',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_RELATED_PER_PAGE,
		'label'       => esc_html__('Post per page', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_RELATED_PER_PAGE),
		'priority'    => $priority_product_detail++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'number',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_RELATED_COLS,
		'label'       => esc_html__('Column', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_RELATED_COLS),
		'priority'    => $priority_product_detail++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_RELATED_ORDER_BY,
		'label'       => esc_html__('Order By', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_RELATED_ORDER_BY),
		'priority'    => $priority_product_detail++,
		'placeholder' => esc_html__('Select condition...', 'automize'),
		'choices'     => [
			'rand'       => esc_html__('Random', 'automize'),
			'title'      => esc_html__('Title', 'automize'),
			'id'         => esc_html__('ID', 'automize'),
			'date'       => esc_html__('Date', 'automize'),
			'modified'   => esc_html__('Modified', 'automize'),
			'menu_order' => esc_html__('Menu order', 'automize'),
			'price'      => esc_html__('Price', 'automize'),
			'none'       => esc_html__('None', 'automize'),
		],
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_RELATED_ORDER,
		'label'       => esc_html__('Order', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_RELATED_ORDER),
		'priority'    => $priority_product_detail++,
		'placeholder' => esc_html__('Select order...', 'automize'),
		'choices'     => [
			'asc'  => esc_html__('Ascending', 'automize'),
			'desc' => esc_html__('Descending', 'automize'),
		],
	]
);
// </editor-fold>

// <editor-fold desc="Upsells">
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_DETAIL_GROUP_TITLE . '_' . ( $priority_product_detail++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'priority' => $priority_product_detail++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Upsells', 'automize') . '</div>',
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_UP_SELLS_STATUS,
		'label'       => esc_html__('Enable', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_UP_SELLS_STATUS),
		'priority'    => $priority_product_detail++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'number',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_UP_SELLS_PER_PAGE,
		'label'       => esc_html__('Post per page', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_UP_SELLS_PER_PAGE),
		'priority'    => $priority_product_detail++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'number',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_UP_SELLS_COLS,
		'label'       => esc_html__('Column', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_UP_SELLS_COLS),
		'priority'    => $priority_product_detail++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_UP_SELLS_ORDER_BY,
		'label'       => esc_html__('Order By', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_UP_SELLS_ORDER_BY),
		'priority'    => $priority_product_detail++,
		'placeholder' => esc_html__('Select condition...', 'automize'),
		'choices'     => [
			'rand'       => esc_html__('Random', 'automize'),
			'title'      => esc_html__('Title', 'automize'),
			'id'         => esc_html__('ID', 'automize'),
			'date'       => esc_html__('Date', 'automize'),
			'modified'   => esc_html__('Modified', 'automize'),
			'menu_order' => esc_html__('Menu order', 'automize'),
			'price'      => esc_html__('Price', 'automize'),
			'none'       => esc_html__('None', 'automize'),
		],
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_UP_SELLS_ORDER,
		'label'       => esc_html__('Order', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_DETAIL,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_UP_SELLS_ORDER),
		'priority'    => $priority_product_detail++,
		'placeholder' => esc_html__('Select order...', 'automize'),
		'choices'     => [
			'asc'  => esc_html__('Ascending', 'automize'),
			'desc' => esc_html__('Descending', 'automize'),
		],
	]
);
// </editor-fold>

// </editor-fold>

// </editor-fold>

// <editor-fold desc="Product Catalog">
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_GROUP_TITLE . '_1',
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG,
		'priority' => 1,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Woocommerce', 'automize') . '</div>',
	]
);

$priority_product_catalog = 10;

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'number',
		'settings'        => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_CATEGORIES_PER_ROW,
		'label'           => esc_html__('Categories per row', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_CATEGORIES_PER_ROW),
		'priority'        => $priority_product_catalog++,
		'description'     => __('How many categories should be shown per row on shop or category page?', 'automize'),
		'choices'         => [
			'min'  => 2,
			'max'  => 5,
			'step' => 1,
		],
		'active_callback' => [
			[
				[
					'setting'  => 'woocommerce_shop_page_display',
					'operator' => '!=',
					'value'    => '',
				],
				[
					'setting'  => 'woocommerce_category_archive_display',
					'operator' => '!=',
					'value'    => '',
				],
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_LAYOUT_TYPE,
		'label'       => esc_html__('Layout Type', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_LAYOUT_TYPE),
		'priority'    => $priority_product_catalog++,
		'placeholder' => esc_html__('Select a layout type...', 'automize'),
		'choices'     => [
			'full'      => esc_html__('Full Width', 'automize'),
			'container' => esc_html__('Container', 'automize'),
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PAGINATION,
		'label'       => esc_html__('Pagination Type', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PAGINATION),
		'priority'    => $priority_product_catalog++,
		'placeholder' => esc_html__('Select a pagination type...', 'automize'),
		'choices'     => [
			'pagination' => esc_html__('Pagination', 'automize'),
			'load_more'  => esc_html__('Load More', 'automize'),
			'infinity'   => esc_html__('Infinity Scroll', 'automize'),
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_FILTER_POSITION,
		'label'       => esc_html__('Filter Position', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_FILTER_POSITION),
		'priority'    => $priority_product_catalog++,
		'placeholder' => esc_html__('Select a position...', 'automize'),
		'choices'     => [
			'off'           => esc_html__('Off', 'automize'),
			'left'          => esc_html__('Left', 'automize'),
			'right'         => esc_html__('Right', 'automize'),
			'top'           => esc_html__('Top', 'automize'),
			'canvas_left'   => esc_html__('Left Canvas', 'automize'),
			'canvas_right'  => esc_html__('Right Canvas', 'automize'),
			'canvas_top'    => esc_html__('Top Canvas', 'automize'),
			'canvas_bottom' => esc_html__('Bottom Canvas', 'automize'),
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PAGINATION . '_' . ( $priority_product_catalog++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG,
		'priority' => $priority_product_catalog,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Product Item', 'automize') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_WISHLIST,
		'label'       => esc_html__('Show Wishlist', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_WISHLIST),
		'priority'    => $priority_product_catalog++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_COMPARE,
		'label'       => esc_html__('Show Compare', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_COMPARE),
		'priority'    => $priority_product_catalog++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_RATING,
		'label'       => esc_html__('Show Rating', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_RATING),
		'priority'    => $priority_product_catalog++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_QUICK_VIEW,
		'label'       => esc_html__('Show Quick View', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_QUICK_VIEW),
		'priority'    => $priority_product_catalog++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_ADD_TO_CART,
		'label'       => esc_html__('Show Add To Cart', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_ADD_TO_CART),
		'priority'    => $priority_product_catalog++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_STOCK,
		'label'       => esc_html__('Show Stock', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_STOCK),
		'priority'    => $priority_product_catalog++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_CUSTOM_FIELDS,
		'label'       => esc_html__('Show Custom Fields', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_CUSTOM_FIELDS),
		'priority'    => $priority_product_catalog++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'textarea',
		'settings'        => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_CUSTOM_FIELDS_KEYWORD,
		'label'           => esc_html__('Enter keywords for Custom Fields', 'automize'),
		'description'     => esc_html__('keywords separated by a new line or comma. If no custom field is selected, then all fields will be shown.', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG,
		'priority'        => $priority++,
		'choices'         => [
			'alpha' => true,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_CUSTOM_FIELDS,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);
// </editor-fold>
// <editor-fold desc="Product Images">
$priority_product_images = 1;
RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_IMAGES,
	[
		'title'          => esc_html__('Product Images', 'automize'),
		'description'    => esc_html__('Product Image Settings.', 'automize'),
		'panel'          => 'woocommerce',
		'priority'       => 10,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGES_TITLE . '_' . ( $priority_product_images++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_IMAGES,
		'priority' => $priority_product_images++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Images Hover', 'automize') . '</div>',
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'toggle',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGES_SHOW,
		'label'           => esc_html__('Enable Hover Product Images', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_IMAGES,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGES_SHOW),
		'priority'        => $priority_product_images++,
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'select',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGE_EFFECT,
		'label'           => esc_html__('Select Effects', 'automize'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_IMAGES,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGES_SHOW),
		'placeholder'     => esc_html__('Select position...', 'automize'),
		'priority'        => $priority_product_images++,
		'choices'         => [
			'fade_in_image'    => esc_html__('Secondary Image', 'automize'),
			'zoom_in_image'    => esc_html__('Zoom In', 'automize'),
			'zoom_out_image'   => esc_html__('Zoom Out', 'automize'),
			'blur_image'       => esc_html__('Blur', 'automize'),
			'shiny_slide'      => esc_html__('Shiny Slide', 'automize'),
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGES_SHOW,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGES_CROPPING_TITLE . '_' . ( $priority_product_images++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_IMAGES,
		'priority' => $priority_product_images++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Thumbnail Images', 'automize') . '</div>',
	]
);
