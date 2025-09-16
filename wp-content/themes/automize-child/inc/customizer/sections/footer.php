<?php
/**
 * The footer section - Child Theme Override
 *
 * @package Automize_Child
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

use RisingBambooTheme\App\App;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;
use RisingBambooTheme\Customizer\Helper as RisingBambooCustomizerHelper;
use RisingBambooCore\Helper\Helper as RisingBambooCoreHelper;

RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_LAYOUT_FOOTER,
	[
		'title'          => esc_html__('Footer', 'automize'),
		'description'    => esc_html__('Theme footer.', 'automize'),
		'panel'          => RISING_BAMBOO_KIRKI_PANEL_LAYOUT,
		'priority'       => 20,
	]
);

$priority = 1;
/**
 * The fields of this section.
 */
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_FOOTER_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_FOOTER,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Layout', 'automize') . '</div>',
	]
);

// Override untuk menggunakan child theme template files
$child_footers_path = get_stylesheet_directory() . '/template-parts/footers/';
$parent_footers_path = get_template_directory() . '/template-parts/footers/';

// Cek apakah ada template di child theme, jika tidak gunakan parent theme
if (is_dir($child_footers_path) && count(glob($child_footers_path . '*.php')) > 0) {
    // Gunakan child theme files
    $files = glob($child_footers_path . '*.php');
    $_layout_list = [];
    foreach ($files as $file) {
        $filename = basename($file, '.php');
        $_layout_list[$filename] = ucwords(str_replace(['-', '_'], ' ', $filename));
    }
} else {
    // Fallback ke parent theme
    $files = glob($parent_footers_path . '*.php');
    $_layout_list = [];
    foreach ($files as $file) {
        $filename = basename($file, '.php');
        $_layout_list[$filename] = ucwords(str_replace(['-', '_'], ' ', $filename));
    }
}

if ( RisingBambooCoreHelper::elementor_activated() ) {
	$_layout_list = RisingBambooCustomizerHelper::get_elementor_footers();
}

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_FOOTER,
		'label'       => esc_html__('Layout', 'automize'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_FOOTER,
		'default'     => RisingBambooCustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_FOOTER),
		'placeholder' => esc_html__('Select a footer...', 'automize'),
		'priority'    => $priority++,
		'multiple'    => 1,
		'choices'     => $_layout_list,
	] 
);
