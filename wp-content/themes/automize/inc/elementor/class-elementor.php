<?php
/**
 * RisingBamboo Package
 *
 * @package RisingBamboo
 */

namespace RisingBambooTheme\Elementor;

use Elementor\Plugin;
use RisingBambooTheme\Core\Singleton;
use RisingBambooTheme\Helper\Helper;

/**
 * Elementor Location
 * https://developers.elementor.com/theme-locations-api/registering-locations/
 *
 * @package rising_bamboo
 */
class Elementor extends Singleton {


	/**
	 * Construction.
	 */
	public function __construct() {
		if ( Helper::elementor_activated() ) {
			add_action('elementor/theme/register_locations', [ $this, 'register_elementor_locations' ]);
			add_filter('rising_bamboo_page_title', [ $this, 'check_hide_title' ]);
		}
	}

	/**
	 * Register Elementor Locations.
	 *
	 * @param mixed $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	public function register_elementor_locations( $elementor_theme_manager ): void {
		$elementor_theme_manager->register_all_core_location();
	}

	/**
	 * Check hide title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	public function check_hide_title( bool $val ): bool {
		if ( defined('ELEMENTOR_VERSION') ) {
			$current_doc = Plugin::instance()->documents->get(get_the_ID());
			if ( $current_doc && 'yes' === $current_doc->get_settings('hide_title') ) {
				$val = false;
			}
		}
		return $val;
	}
}
