<?php
/**
 * RisingBambooCore
 *
 * @package RisingBambooCore
 */

namespace RisingBambooCore\Elementor;

use Elementor\Plugin;
use RisingBambooCore\Core\Singleton;
use RisingBambooCore\App\App;
use RisingBambooCore\App\Admin\FooterPostType;
use RisingBambooCore\App\Admin\MegaMenu;
use RisingBambooCore\App\Admin\TestimonialPostType;
use RisingBambooCore\Elementor\Widgets\Widget;
use RisingBambooCore\Elementor\Controls\Control as RbbControl;
use RisingBambooCore\Helper\Helper as CoreHelper;
use RisingBambooCore\Helper\Theme as ThemeHelper;

/**
 * Elementor.
 */
class Elementor extends Singleton {

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	public const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		Ajax::instance();
		add_action('plugins_loaded', [ $this, 'on_plugins_loaded' ]);
	}

	/**
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_plugins_loaded(): void {

		if ( $this->is_compatible() ) {
			add_action('elementor/init', [ $this, 'init' ]);
			add_action('elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_scripts' ]);
			if ( current_user_can('manage_options') && is_admin() ) {
				add_action('elementor/init', [ $this, 'update_default_settings' ]);
				add_action('after_switch_theme', [ $this, 'add_cpt_support' ]);
				add_action('merlin_after_all_import', [ $this, 'add_cpt_support' ]);
			}
		}
	}

	/**
	 * Compatibility Checks
	 *
	 * Checks if the installed version of Elementor meets the plugin's minimum requirement.
	 * Checks if the installed PHP version meets the plugin's minimum requirement.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function is_compatible(): bool {
		if ( ! did_action('elementor/loaded') ) {
			add_action('admin_notices', [ $this, 'admin_notice_missing_main_plugin' ]);
			return false;
		}
		if ( ! version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=') ) {
			add_action('admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ]);
			return false;
		}
		return true;
	}

	/**
	 * Initialize the plugin
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init(): void {
		add_action('elementor/elements/categories_registered', [ Widget::class, 'widget_categories' ]);
		add_action('elementor/widgets/register', [ Widget::class, 'register' ]);
		add_action('elementor/controls/register', [ RbbControl::class, 'register' ]);
	}

	/**
	 * Add Rbb Font Icon.
	 */
	public function enqueue_scripts(): void {
		if ( ! wp_style_is('rbb-icons') ) {
			wp_enqueue_style('rbb-icons', RBB_CORE_URL . 'dist/css/rbb-icons.css', [], App::get_rbb_icons_version());
		}
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin(): void {
		if ( isset($_GET['activate']) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			unset($_GET['activate']); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		}
		$message = sprintf(
			// translators: 1: Name, 2: Elementor.
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', App::get_domain()),
			'<strong>' . esc_html__('Rising Bamboo', App::get_domain()) . '</strong>',
			'<strong>' . esc_html__('Elementor', App::get_domain()) . '</strong>'
		);
		// translators: 1: Message.
		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version(): void {
		if ( isset($_GET['activate']) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			unset($_GET['activate']); // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		}
		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', App::get_domain()),
			'<strong>' . esc_html__('Rising Bamboo', App::get_domain()) . '</strong>',
			'<strong>' . esc_html__('Elementor', App::get_domain()) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);
		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Disable default global setting of elementor.
	 *
	 * @return void
	 */
	public function update_default_settings(): void {
		$kit          = Plugin::$instance->kits_manager->get_active_kit();
		$kit_settings = $kit->get_settings();
		// Only update kit settings if the global image lightbox is not already disabled.
		$lightbox_disabled = isset($kit_settings['global_image_lightbox']) &&
							( 0 === $kit_settings['global_image_lightbox'] ||
							'0' === $kit_settings['global_image_lightbox'] ||
							false === $kit_settings['global_image_lightbox'] ||
							'' === $kit_settings['global_image_lightbox'] );

		if ( ! $lightbox_disabled ) {
			$kit->update_settings(
				[
					'global_image_lightbox' => 0,
				]
			);
		}
		update_option('elementor_disable_color_schemes', 'yes');
		update_option('elementor_disable_typography_schemes', 'yes');
	}

	/**
	 * Add elementor support for custom post type.
	 *
	 * @return void
	 */
	public function add_cpt_support(): void {
		// Only proceed if current theme is a Rising Bamboo theme.
		if ( ! ThemeHelper::instance()->is_rbb_theme(wp_get_theme()) ) {
			return;
		}
		$cpt_support = get_option('elementor_cpt_support');
		if ( ! $cpt_support ) {
			// Create array of our default supported post types.
			$cpt_support = [
				'page',
				'post',
			];
		}
		if ( CoreHelper::woocommerce_activated() ) {
			if ( ! in_array('product', $cpt_support, true) ) {
				$cpt_support[] = 'product';
			}
		}
		if ( class_exists(FooterPostType::class) && ! in_array(FooterPostType::POST_TYPE, $cpt_support, true) ) {
			$cpt_support[] = FooterPostType::POST_TYPE;
		}
		if ( class_exists(MegaMenu::class) && ! in_array(MegaMenu::POST_TYPE, $cpt_support, true) ) {
			$cpt_support[] = MegaMenu::POST_TYPE;
		}
		if ( class_exists(TestimonialPostType::class) && ! in_array(TestimonialPostType::POST_TYPE, $cpt_support, true) ) {
			$cpt_support[] = TestimonialPostType::POST_TYPE;
		}
		update_option('elementor_cpt_support', $cpt_support);
	}
}
