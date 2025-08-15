<?php
/**
 * Import while setup theme.
 *
 * @package RisingBambooTheme
 */

$setup_demo_import      = 'https://automize.risingbamboo.com/imports/';
$setup_demo_import_data = [
	[
		'import_file_name'           => __('Essential', 'automize'),
		'import_file_url'            => $setup_demo_import . 'setup/essential.xml',
	],
];

if ( class_exists(WooCommerce::class) ) {
	$setup_demo_import_data[] = [
		'import_file_name'           => __('Extra Data ( Post, Product, Menu ...)', 'automize'),
		'import_file_url'            => $setup_demo_import . 'setup/extra.xml',
	];
}

return $setup_demo_import_data;
