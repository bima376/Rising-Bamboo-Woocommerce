<?php
/**
 * RisingBambooCore
 *
 * @package RisingBambooCore
 */

namespace RisingBambooCore\Elementor\Widgets\WooProducts;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use RisingBambooCore\App\App;
use RisingBambooCore\Core\View;
use RisingBambooCore\Elementor\Controls\Control as RisingBambooElementorControl;
use RisingBambooCore\Elementor\Widgets\Base;
use RisingBambooCore\Elementor\Widgets\Widget;
use RisingBambooCore\Helper\Helper;
use RisingBambooCore\Helper\Elementor as ElementorHelper;

/**
 * Elementor Products Widget.
 */
class LookBook extends Base {

	/**
	 * Prefix.
	 *
	 * @var string
	 */
	protected string $prefix = 'rbb_lookbook';

	/**
	 * Active Break Points.
	 *
	 * @var array|\Elementor\Core\Breakpoints\Breakpoint|\Elementor\Core\Breakpoints\Breakpoint[]
	 */
	public array $active_break_points = [];

	/**
	 * Construct.
	 *
	 * @param array $data Data.
	 * @param mixed $args Args.
	 * @throws \Exception Exception.
	 */
	public function __construct( array $data = [], $args = null ) {
		parent::__construct($data, $args);
		$this->active_break_points = ElementorHelper::get_active_breakpoints();
		Helper::register_asset('rbb-lookbook', 'js/frontend/elementor/widgets/woo-products/lookbook.js', [ 'jquery' ], App::get_version());
	}
	/**
	 * The method is a simple one, you just need to return a widget name that will be used in the code.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return 'rbb_lookbook';
	}

	/**
	 * The method, which again, is a very simple one,
	 * you need to return the widget title that will be displayed as the widget label.
	 *
	 * @return string
	 */
	public function get_title(): string {
		return __('Lookbook', App::get_domain());
	}

	/**
	 * The method lets you set the category of the widget, return the category name as a string.
	 *
	 * @return string[]
	 */
	public function get_categories(): array {
		return [ Widget::ELEMENTOR_CATEGORY ];
	}

	/**
	 * Get dependency script.
	 *
	 * @return string[]
	 */
	public function get_script_depends(): array {
		return [ 'rbb-lookbook' ];
	}

	/**
	 * Get dependency style.
	 *
	 * @return string[]
	 */
	public function get_style_depends(): array {
		return [];
	}

	/**
	 * The method lets you define which controls (setting fields) your widget will have.
	 */
	protected function register_controls(): void { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore

		$this->content_section();

		$this->general_section();

		$this->style_tab();
	}

	/**
	 * Content section.
	 *
	 * @return void
	 */
	protected function content_section(): void {
		$this->start_controls_section(
			$this->get_name_setting('content_section'),
			[
				'label' => esc_html__('Content', App::get_domain()),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			$this->get_name_setting('spot'),
			[
				'label'          => __('Type', App::get_domain()),
				'multiple'       => false,
				'type'           => Controls_Manager::SELECT,
				'default'        => 'product',
				'options'        => [
					'product' => esc_html__('Product', App::get_domain()),
					'content' => esc_html__('Content', App::get_domain()),
				],
			]
		);
		$repeater->add_control(
			$this->get_name_setting('product'),
			[
				'label'          => __('Product', App::get_domain()),
				'multiple'       => false,
				'type'           => RisingBambooElementorControl::SELECT2,
				'select2options' => [
					'placeholder'        => __('Write Title Product', App::get_domain()),
					'ajax'               => [
						'url'      => admin_url('admin-ajax.php') . '?action=rbb_get_product&nonce=' . wp_create_nonce(App::get_nonce()),
						'dataType' => 'json',
						'delay'    => 500,
						'cache'    => 'true',
					],
					'minimumInputLength' => 3,
				],
				'condition'      => [
					$this->get_name_setting('spot') => 'product',
				],
			]
		);

		$repeater->add_control(
			$this->get_name_setting('content_title'),
			[
				'label'          => __('Title', App::get_domain()),
				'type'           => Controls_Manager::TEXT,
				'condition'      => [
					$this->get_name_setting('spot') => 'content',
				],
			]
		);
		$repeater->add_control(
			$this->get_name_setting('content_sub_title'),
			[
				'label'          => __('Sub Title', App::get_domain()),
				'type'           => Controls_Manager::TEXT,
				'condition'      => [
					$this->get_name_setting('spot') => 'content',
				],
			]
		);
		$repeater->add_control(
			$this->get_name_setting('content_description'),
			[
				'label'          => __('Description', App::get_domain()),
				'type'           => Controls_Manager::TEXT,
				'condition'      => [
					$this->get_name_setting('spot') => 'content',
				],
			]
		);
		$repeater->add_control(
			$this->get_name_setting('content_image'),
			[
				'label'          => __('Image', App::get_domain()),
				'type'           => Controls_Manager::MEDIA,
				'condition'      => [
					$this->get_name_setting('spot') => 'content',
				],
			]
		);

		$this->offset_group_control($repeater, 'spot', true);

		$repeater->add_control(
			$this->get_name_setting('spot_size'),
			[
				'label'      => __('Spot Size', App::get_domain()),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [
					'px' => [
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					],
					'em' => [
						'min'  => 0.5,
						'max'  => 5,
						'step' => 0.1,
					],
					'%' => [
						'min'  => 1,
						'max'  => 10,
						'step' => 0.1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 24,
				],
				'selectors'  => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .spot-marker' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			$this->get_name_setting('spots'),
			[
				'label'  => esc_html__('Spots', App::get_domain()),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);

		$this->add_control(
			'hr' . $this->uniqID(),
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			$this->get_name_setting('background_image'),
			[
				'label' => __('Background', App::get_domain()),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			$this->get_name_setting('background_link'),
			[
				'label'       => esc_html__('Link', App::get_domain()),
				'type'        => Controls_Manager::URL,
				'placeholder' => esc_html__('Put your URL here', App::get_domain()),
				'options'     => [ 'url', 'is_external', 'nofollow' ],
				'default'     => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			$this->get_name_setting('trigger_type'),
			[
				'label'       => esc_html__('Spot Trigger Method', App::get_domain()),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'click',
				'options'     => [
					'click' => esc_html__('Click', App::get_domain()),
					'hover' => esc_html__('Hover', App::get_domain()),
				],
				'description' => esc_html__('Choose how the product spots should be activated.', 'rising-bamboo'),
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'hr' . $this->uniqID(),
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			$this->get_name_setting('show_add_to_cart'),
			[
				'label'        => __('Show Add to cart', App::get_domain()),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', App::get_domain()),
				'label_off'    => esc_html__('Hide', App::get_domain()),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			$this->get_name_setting('show_wishlist'),
			[
				'label'        => __('Show Wishlist', App::get_domain()),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', App::get_domain()),
				'label_off'    => esc_html__('Hide', App::get_domain()),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			$this->get_name_setting('show_quickview'),
			[
				'label'        => __('Show Quick View', App::get_domain()),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', App::get_domain()),
				'label_off'    => esc_html__('Hide', App::get_domain()),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			$this->get_name_setting('show_compare'),
			[
				'label'        => __('Show Compare', App::get_domain()),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', App::get_domain()),
				'label_off'    => esc_html__('Hide', App::get_domain()),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			$this->get_name_setting('show_rating'),
			[
				'label'        => __('Show Rating', App::get_domain()),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', App::get_domain()),
				'label_off'    => esc_html__('Hide', App::get_domain()),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			$this->get_name_setting('show_percentage_discount'),
			[
				'label'        => __('Show Percentage Discount', App::get_domain()),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', App::get_domain()),
				'label_off'    => esc_html__('Hide', App::get_domain()),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * General Section.
	 *
	 * @return void
	 */
	protected function general_section(): void {
		$this->start_controls_section(
			$this->get_name_setting('general_section'),
			[
				'label' => __('General', App::get_domain()),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			$this->get_name_setting('general_show_title'),
			[
				'label'        => __('Show Title', App::get_domain()),
				'description'  => __('Show/Hide the title', App::get_domain()),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', App::get_domain()),
				'label_off'    => esc_html__('Hide', App::get_domain()),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			$this->get_name_setting('general_title'),
			[
				'label'       => __('Title', App::get_domain()),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __('Type your title here', App::get_domain()),
			]
		);
		$this->add_control(
			$this->get_name_setting('general_subtitle'),
			[
				'label'       => __('Subtitle', App::get_domain()),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => __('Type your Extra Subtitle here', App::get_domain()),
			]
		);
		$this->add_control(
			$this->get_name_setting('general_description'),
			[
				'label'       => __('Description', App::get_domain()),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => '',
				'placeholder' => __('Type your description here', App::get_domain()),
			]
		);
		$this->add_control(
			'hr' . $this->uniqID(),
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			$this->get_name_setting('general_layout'),
			[
				'label'   => __('Layout', App::get_domain()),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => Helper::list_templates('elementor/widgets/woo-product-lookbook'),
			]
		);
		$this->end_controls_section();
	}

	/**
	 * The method, which is where you actually render the code and generate the final HTML on the frontend using PHP.
	 */
	protected function style_tab(): void {
		$this->style_background_section();
		$this->style_title_section();
		$this->style_subtitle_section();
	}

	/**
	 * Background section in style tab.
	 *
	 * @return void
	 */
	protected function style_background_section(): void {
		$this->start_controls_section(
			$this->get_name_setting('style_background_section'),
			[
				'label' => __('Background', App::get_domain()),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => $this->get_name_setting('style_background'),
				'label'    => __('Background', App::get_domain()),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .rbb_lookbook',
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Title section in Style Tab
	 *
	 * @title Title section in Style tab.
	 * @return void
	 */
	protected function style_title_section(): void {
		$this->start_controls_section(
			$this->get_name_setting('style_title_section'),
			[
				'label' => __('Title', App::get_domain()),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			$this->get_name_setting('style_title_color'),
			[
				'label'     => __('Color', App::get_domain()),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .rbb_lookbook .title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			$this->get_name_setting('style_title_bg_color'),
			[
				'label'     => __('Background', App::get_domain()),
				'type'      => Controls_Manager::COLOR,
				'global'    => [
					'default' => Global_Colors::COLOR_PRIMARY,
				],
				'selectors' => [
					'{{WRAPPER}} .rbb_lookbook .title' => 'background: {{VALUE}};padding:5px;',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => $this > $this->get_name_setting('style_title_typography'),
				'selector' => '{{WRAPPER}} .rbb_lookbook .title',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);
		$this->add_responsive_control(
			$this->get_name_setting('style_title_bottom_space'),
			[
				'label'      => __('Spacing', App::get_domain()),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 5,
					],
					'rem' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rbb_lookbook .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Subtitle section on Style Tab.
	 *
	 * @title  Subtitle Section in Style Tab
	 * @return void
	 */
	protected function style_subtitle_section(): void {
		$this->start_controls_section(
			$this->get_name_setting('style_subtitle_section'),
			[
				'label' => __('Subtitle', App::get_domain()),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			$this->get_name_setting('style_subtitle_color'),
			[
				'label'     => __('Color', App::get_domain()),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rbb_lookbook .sub-title' => 'color: {{VALUE}};',
				],
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);
		$this->add_control(
			$this->get_name_setting('style_subtitle_bg_color'),
			[
				'label'     => __('Background', App::get_domain()),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .rbb_lookbook .sub-title' => 'background: {{VALUE}};padding:5px;',
				],
				'global'    => [
					'default' => Global_Colors::COLOR_TEXT,
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => $this->get_name_setting('style_subtitle_typography'),
				'selector' => '{{WRAPPER}} .rbb_lookbook .sub-title',
				'global'   => [
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				],
			]
		);
		$this->add_responsive_control(
			$this->get_name_setting('style_subtitle_bottom_space'),
			[
				'label'      => __('Spacing', App::get_domain()),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'rem', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 5,
					],
					'rem' => [
						'min' => 0,
						'max' => 5,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rbb_lookbook .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render.
	 *
	 * @return void
	 */
	protected function render(): void {
		$layout = $this->get_value_setting('general_layout', 'default');
		View::instance()->load(
			'elementor/widgets/woo-product-lookbook/' . strtolower($layout),
			[
				'widget'                         => $this,
				'id'                             => $this->uniqID(),
				'spots'                          => $this->get_value_setting('spots'),
				'title'                          => $this->get_value_setting('general_title'),
				'subtitle'                       => $this->get_value_setting('general_subtitle'),
				'description'                    => $this->get_value_setting('general_description'),
				'show_title'                     => $this->get_value_setting('general_show_title'),
				'background_image'               => ElementorHelper::get_elementor_image_url($this->get_value_setting('background_image')),
				'background_link'                => $this->get_value_setting('background_link'),
				'layout'                         => strtolower($layout),
				'active_break_points'            => $this->active_break_points,
				'trigger_type'                   => $this->get_value_setting('trigger_type'),
				'show_add_to_cart'               => $this->get_value_setting('show_add_to_cart'),
				'show_wishlist'                  => $this->get_value_setting('show_wishlist'),
				'show_compare'                   => $this->get_value_setting('show_compare'),
				'show_rating'                    => $this->get_value_setting('show_rating'),
				'show_quickview'                 => $this->get_value_setting('show_quickview'),
				'show_percentage_discount'       => $this->get_value_setting('show_percentage_discount'),
			]
		);
	}
}
