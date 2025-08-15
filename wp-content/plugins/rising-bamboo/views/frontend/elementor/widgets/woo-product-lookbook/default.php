<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

use RisingBambooCore\Core\View;
use RisingBambooCore\Helper\Elementor as ElementorHelper;

global $product;

defined('ABSPATH') || exit;
?>
<div class="rbb_lookbook <?php echo esc_attr($layout); ?> trigger-<?php echo esc_attr($trigger_type); ?>">
	<?php
	if ( $show_title ) {
		?>
		<div class="mb-9 heading_block">
			<?php if ( $title ) { ?>
				<h2 class="title font-bold"><?php echo esc_html($title); ?></h2>
			<?php } ?>
			<?php if ( $subtitle ) { ?>
				<span class="sub-title block"><?php echo esc_html($subtitle); ?></span>
			<?php } ?>
			
			<?php if ( $description ) { ?>
				<span class="desc block"><?php echo esc_html($description); ?></span>
			<?php } ?>
		</div>
		<?php
	}
	?>
	<div class="content_block">
		<?php
		if ( $background_image ) {
			$target   = $background_link['is_external'] ? ' target="_blank"' : '';
			$nofollow = $background_link['nofollow'] ? ' rel="nofollow"' : '';
			if ( ! empty($background_link['url']) ) :
				?>
				<a href="<?php echo esc_url($background_link['url']); ?>"<?php echo esc_attr($target) . esc_attr($nofollow); ?>>
			<?php endif; ?>
			<img alt="<?php echo esc_attr($title); ?>" loading="lazy" class="relative w-full h-full object-cover"
				src="<?php echo esc_url($background_image); ?>"/>
			<?php if ( ! empty($background_link['url']) ) : ?>
				</a>
				<?php
			endif;
		}
		?>
		
		<?php
		foreach ( $spots as $spot ) {
			$spot_type = $spot[ $widget->get_name_setting('spot') ];
			$position  = $spot[ $widget->get_name_setting('spot_position') ] ?? 'absolute';
			?>
			<div class="spot <?php echo esc_attr($spot_type); ?> item elementor-repeater-item-<?php echo esc_attr($spot['_id']); ?> <?php echo 'absolute' === $position ? '!absolute' : '!relative'; ?>">
				<button class="lookbook-spot-trigger spot-marker rounded-full bg-white bg-opacity-80 border-2 border-blue-500 flex items-center justify-center shadow-md transform transition-all duration-300 ease-in-out hover:scale-110 hover:bg-primary hover:text-white focus:outline-none relative group">
					<span class="w-2 h-2 bg-primary rounded-full group-hover:bg-white transition-all duration-300"></span>
					<span class="absolute inset-0 rounded-full border-2 border-blue-500 opacity-75 animate-ping"></span>
					<span class="absolute inset-0 rounded-full bg-primary opacity-0 group-hover:opacity-25 transform scale-0 group-hover:scale-150 transition-all duration-500 ease-out"></span>
				</button>
				<div class="spot-content absolute z-50 hidden">
					<?php
					if ( 'product' === $spot_type ) {
						$product = wc_get_product($spot[ $widget->get_name_setting('product') ]);
						View::instance()->load(
							'elementor/widgets/woo-product-lookbook/fragments/item',
							[
								'product' => $product,
							]
						);
					} else {
						View::instance()->load(
							'elementor/widgets/woo-product-lookbook/fragments/content',
							[
								'title'       => $spot[ $widget->get_name_setting('content_title') ],
								'subtitle'    => $spot[ $widget->get_name_setting('content_sub_title') ],
								'description' => $spot[ $widget->get_name_setting('content_description') ],
								'image'       => ElementorHelper::get_elementor_image_url($spot[ $widget->get_name_setting('content_image') ]),
							]
						);
					}
					?>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>