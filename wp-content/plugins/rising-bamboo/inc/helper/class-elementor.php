<?php
/**
 * RisingBambooCore
 *
 * @package RisingBambooCore.
 */

namespace RisingBambooCore\Helper;

use Elementor\Core\Breakpoints\Breakpoint;
use Elementor\Core\Breakpoints\Manager;
use Elementor\Plugin;

/**
 * Rising Bamboo Elementor Helper Class.
 */
class Elementor {



	/**
	 * Get custom attributes for url.
	 *
	 * @param string $attributes Attributes.
	 * @return array
	 */
	public static function get_custom_attributes( string $attributes ): array {
		$result         = [];
		$attributes_arr = explode(',', $attributes);
		foreach ( $attributes_arr as $attribute ) {
			if ( preg_match('/(.*)\|(.*)/', $attribute, $preg) ) {
				$result[ trim($preg[1]) ] = trim($preg[2]);
			}
		}
		return $result;
	}

	/**
	 * Get all breakpoints of elementor.
	 *
	 * @return Breakpoint|Breakpoint[]
	 */
	public static function get_active_breakpoints() {
		$break_point_manager = Plugin::$instance->breakpoints;
		$active_break_points = $break_point_manager->get_active_breakpoints();
		$desktop_min_point   = $break_point_manager->get_desktop_min_point();
		if ( isset($active_break_points[ Manager::BREAKPOINT_KEY_WIDESCREEN ]) ) {
			$widescreen = $active_break_points[ Manager::BREAKPOINT_KEY_WIDESCREEN ];
			unset($active_break_points[ Manager::BREAKPOINT_KEY_WIDESCREEN ]);
		}
		$desktop_break_point                                    = new Breakpoint(
			[
				'name'          => Manager::BREAKPOINT_KEY_DESKTOP,
				'label'         => 'Desktop',
				'default_value' => isset($widescreen) ? $widescreen->get_value() - 1 : $desktop_min_point,
				'direction'     => isset($widescreen) ? 'max' : 'min',
				'is_enabled'    => true,
			]
		);
		$active_break_points[ Manager::BREAKPOINT_KEY_DESKTOP ] = $desktop_break_point;
		if ( isset($widescreen) ) {
			$active_break_points[ Manager::BREAKPOINT_KEY_WIDESCREEN ] = $widescreen;
		}
		return $active_break_points;
	}

	/**
	 * Get break point mobile first type.
	 *
	 * @param mixed $breakpoints Break point.
	 * @return array
	 */
	public static function get_breakpoint_mobile_first( $breakpoints ): array {
		$result = [];
		foreach ( $breakpoints as $breakpoint ) {
			switch ( $breakpoint->get_name() ) {
				case 'mobile':
					$result['mobile'] = 0;
					break;
				case 'mobile_extra':
					$result['mobile_extra'] = $breakpoints['mobile']->get_value();
					break;
				case 'tablet':
					$result['tablet'] = ( isset($breakpoints['mobile_extra']) ) ? $breakpoints['mobile_extra']->get_value() : $breakpoints['mobile']->get_value();
					break;
				case 'tablet_extra':
					$result['tablet_extra'] = $breakpoints['tablet']->get_value();
					break;
				case 'laptop':
					$result['laptop'] = ( isset($breakpoints['tablet_extra']) ) ? $breakpoints['tablet_extra']->get_value() : $breakpoints['tablet']->get_value();
					break;
				case 'desktop':
					$result['desktop'] = Plugin::$instance->breakpoints->get_desktop_min_point();
					break;
				case 'widescreen':
					$result['widescreen'] = $breakpoint->get_value() - 1;
					break;
			}
		}
		return $result;
	}

	/**
	 * Get image URL from Elementor media control.
	 *
	 * @param array|string $image_data The image data from Elementor media control.
	 * @return string The image URL or empty string.
	 */
	public static function get_elementor_image_url( $image_data ): string {
		// If it's already a string, it might be a URL or ID.
		if ( is_string($image_data) ) {
			// Check if it's a URL.
			if ( filter_var($image_data, FILTER_VALIDATE_URL) ) {
				return esc_url($image_data);
			}

			// If it's an attachment ID.
			$url = wp_get_attachment_image_url($image_data, 'full');
			return $url ? esc_url($url) : '';
		}

		// If it's an array (typical Elementor format).
		if ( is_array($image_data) ) {
			// Check if URL is directly provided.
			if ( ! empty($image_data['url']) ) {
				return esc_url($image_data['url']);
			}

			// Check if ID is provided.
			if ( ! empty($image_data['id']) ) {
				$url = wp_get_attachment_image_url($image_data['id'], 'full');
				return $url ? esc_url($url) : '';
			}
		}

		return '';
	}
}
