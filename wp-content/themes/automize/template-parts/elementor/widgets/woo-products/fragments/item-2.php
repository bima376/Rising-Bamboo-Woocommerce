<?php
/**
 * Elementor widget : woo-product.
 *
 * @package RisingBambooTheme
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Helper\Setting;
use RisingBambooTheme\Helper\Tag;
$product_images     = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGES_SHOW);
$effect_images      = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGE_EFFECT);
$product_categories = wc_get_product_terms($product->get_id(), 'product_cat', [ 'fields' => 'all' ]);
$category_name      = '';
$category_link      = '';
foreach ( $product_categories as $category ) {
	if ( 0 === $category->parent ) {
		$children_categories = get_terms(
			[
				'taxonomy'   => 'product_cat',
				'child_of'   => $category->term_id,
				'fields'     => 'ids',
				'hide_empty' => false,
			]
		);
		if ( ! empty($children_categories) ) {
			$first_child_category = get_term($children_categories[0], 'product_cat');
			$category_name        = $first_child_category->name;
			$category_link        = get_term_link($first_child_category);
		}
		break;
	}
}
if ( empty($category_name) && ! empty($product_categories) ) {
	$first_category = reset($product_categories);
	$category_name  = $first_category->name;
	$category_link  = get_term_link($first_category);
}
$custom_field_exists = false;
if ( $show_custom_field ) {
	if ( empty($custom_fields) ) {
		$custom_fields = get_post_custom_keys($product->get_id());
	}
	foreach ( $custom_fields as $custom_field ) {
		if ( in_array($custom_field, $custom_field_ignore, true) || strpos($custom_field, '_') === 0 ) {
			continue;
		}
		if ( $product->get_meta($custom_field) ) {
			$custom_field_exists = true;
			break;
		}
	}
}
?>

<div class="item">
	<div class="item-product relative">
		<div class="thumbnail-container relative overflow-hidden border bg-white rounded-[10px] 			
		<?php 
		echo esc_attr($effect_images);
		echo esc_attr(( true === $product_images ) && \RisingBambooCore\Helper\Woocommerce::get_gallery_image($product, [ 640, 640 ]) ? ' hover-images ' : ' none-hover-images '); 
		?>
		">
		<a class="relative block overflow-hidden" href="<?php echo esc_url($product->get_permalink()); ?>">
			<?php
			echo wp_kses(
				$product->get_image(
					[ 640, 640 ],
					[
						'class' => 'max-w-full w-full',
						'alt'   => esc_attr($product->get_name()),
					]
				),
				'rbb-kses'
			);
			if ( \RisingBambooCore\Helper\Woocommerce::get_gallery_image($product, [ 410, 410 ]) ) {
				$second_image = \RisingBambooCore\Helper\Woocommerce::get_gallery_image($product, [ 410, 410 ])[0];
				?>
				<img class="max-w-full image-cover absolute left-0 top-0 opacity-0" src="<?php echo esc_url($second_image->src); ?>" alt="<?php echo esc_attr__('Second image of ', 'automize') . esc_attr($product->get_name()); ?>"/>
				<?php
			}
			?>
		</a>
		<?php if ( $show_wishlist ) { ?>
			<div class="absolute md:top-5 top-3 md:right-5 right-3">
				<?php echo Tag::wish_list_button($product); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		<?php } ?>
		<div class="product-flags absolute md:left-4 left-3 md:top-5 top-3 z-10 font-semibold text-[11px]">
			<?php if ( 'instock' === $product->get_stock_status() && $product->is_featured() ) { ?>
				<label class="bg-[#66ad53] text-white font-bold py-[5px] px-[13px] leading-[18px] text-[10px] h-[26px] rounded-[26px] block mb-[10px] uppercase text-center min-w-[66px]"><?php echo esc_html__('New', 'automize'); ?></label>
			<?php } ?>
			<?php if ( 'instock' !== $product->get_stock_status() ) { ?>
				<label class="bg-[#66ad53] text-white font-bold py-[5px] px-[13px] leading-[18px] text-[10px] h-[26px] rounded-[26px] block mb-[10px] uppercase text-center min-w-[66px]"><?php echo esc_html__('Sold out', 'automize'); ?></label>
			<?php } ?>
		</div>
		<?php
		$countdown_date_to = $product->get_date_on_sale_to();
		if ( $show_countdown && $countdown_date_to ) {
			$current_date         = new \WC_DateTime();
			$countdown_date_start = $product->get_date_on_sale_from() ?? $product->get_date_modified();
			if ( ( $current_date >= $countdown_date_start ) && ( $current_date <= $countdown_date_to ) ) {
				?>
				<div class="item-countdown absolute inset-x-1 bottom-[15px]">
					<div class="rbb-countdown flex justify-center relative" data-countdown-date="<?php echo esc_attr($countdown_date_to->format('Y/m/d')); ?>">
						<div class="item-time"><span class="data-number">%D</span><span class="name-time"><?php echo esc_html__('Day%!H', 'automize'); ?></span></div>
						<div class="item-time"><span class="data-number">%H</span><span class="name-time"><?php echo esc_html__('Hour%!H', 'automize'); ?></span></div>
						<div class="item-time"><span class="data-number">%M</span><span class="name-time"><?php echo esc_html__('Min%!H', 'automize'); ?></span></div>
						<div class="item-time"><span class="data-number">%S</span><span class="name-time"><?php echo esc_html__('Secs', 'automize'); ?></span></div>
					</div>
				</div>
				<?php
			}
		}
		?>
	</div>
	<div class="product_info w-full mt-[13px] mb-[5px]">
		<div class="product-title">
			<div class="title-category hidden uppercase font-semibold pb-[9px]">
				<a class="text-xs duration-300 !text-[#cdcdcd] hover:!text-[color:var(--rbb-general-secondary-color)]" href="<?php echo esc_url($category_link); ?>">
					<?php echo wp_kses_post($category_name); ?>
				</a>
			</div>
			<a href="<?php echo esc_url($product->get_permalink()); ?>" class="product_name block !font-semibold mb-3">
				<span class="line-clamp-2"><?php echo wp_kses_post($product->get_name()); ?></span>
			</a>
		</div>
		<?php if ( $show_rating ) { ?>
			<div class="product_ratting text-amber-400 flex items-center mb-[17px]">
				<?php echo wc_get_rating_html($product->get_average_rating()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span class="ratting-count font-medium ml-1 text-xs text-[#3f4045]">(<?php echo wp_kses($product->get_rating_count(), 'rbb-kses'); ?>)</span>
			</div>
		<?php } ?>
		<div class="product_price text-base font-bold">
			<?php echo wp_kses($product->get_price_html(), 'rbb-kses'); ?>
			<?php
			if ( $show_percentage_discount && $product->get_sale_price() ) {
				$regular_price   = $product->get_regular_price();
				$sale_price      = $product->get_sale_price();
				$sale_percentage = 100 - round(( $sale_price / $regular_price ) * 100);
				?>
				<label class="2xl:inline-flex align-top hidden relative ml-[15px] min-w-[42px] text-white p-1 text-[0.625rem] rounded-[3px] flex leading-4 items-center h-[22px] justify-center bg-[color:var(--rbb-general-secondary-color)]">
					<?php echo '-' . esc_html($sale_percentage) . '%'; ?>
				</label>
			<?php } ?>
		</div>
		<div class="product-popup bg-white absolute inset-x-0 bottom-0 opacity-0">
			<div class="product-title pt-5">
				<div class="title-category uppercase font-semibold pb-[9px]">
					<a class="text-xs duration-300 !text-[#cdcdcd] hover:!text-[color:var(--rbb-general-secondary-color)]" href="<?php echo esc_url($category_link); ?>">
						<?php echo wp_kses_post($category_name); ?>
					</a>
				</div>
				<a href="<?php echo esc_url($product->get_permalink()); ?>" class="product_name leading-6 block text-sm !font-semibold mb-3">
					<span class="line-clamp-2"><?php echo wp_kses_post($product->get_name()); ?></span>
				</a>
			</div>
			<?php if ( $show_rating ) { ?>
				<div class="product_ratting text-amber-400 flex items-center mb-[17px]">
					<?php echo wc_get_rating_html($product->get_average_rating()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span class="ratting-count font-medium ml-1 text-xs text-[#3f4045]">(<?php echo wp_kses($product->get_rating_count(), 'rbb-kses'); ?>)</span>
				</div>
			<?php } ?>
			<div class="product_price text-base font-bold">
				<?php echo wp_kses($product->get_price_html(), 'rbb-kses'); ?>
				<?php
				if ( $show_percentage_discount && $product->get_sale_price() ) {
					$regular_price   = $product->get_regular_price();
					$sale_price      = $product->get_sale_price();
					$sale_percentage = 100 - round(( $sale_price / $regular_price ) * 100);
					?>
					<label class="md:inline-flex align-top hidden relative ml-[15px] min-w-[42px] text-white p-1 text-[0.625rem] rounded-[3px] flex leading-4 items-center h-[22px] justify-center bg-[color:var(--rbb-general-secondary-color)]">
						<?php echo '-' . esc_html($sale_percentage) . '%'; ?>
					</label>
				<?php } ?>
			</div>
			<?php if ( $show_stock || ( $show_custom_field && true === $custom_field_exists ) ) { ?>
				<div class="pt-5 mt-5 pb-1 border-t-[1px] border-[#e4e4e4]">
					<?php if ( $show_stock ) { ?>
						<div class="pb-2 text-xs font-normal leading-6">
							<?php 
							if ( $product->get_stock_status() === 'instock' ) {
								if ( $product->get_stock_quantity() ) {
									?>
									<span class="stock in-stock text-[#34ad5e]">
										<?php
										// translators: 1: Product stock.
										echo sprintf(esc_html__(' %s Products in stock', 'automize'), esc_html($product->get_stock_quantity()));
										?>
									</span>
								<?php } else { ?>
									<span class="stock in-stock text-[#34ad5e]">
										<?php
										echo sprintf(esc_html__('In Stock', 'automize'));
										?>
									</span>
								<?php } ?>
							<?php } else { ?>
								<span class="stock out-of-stock"><?php echo esc_html__('Out of stock', 'automize'); ?></span>
							<?php } ?>
						</div>
					<?php } ?>
					<?php
					if ( $show_custom_field ) {
						if ( empty($custom_fields) ) {
							$custom_fields = get_post_custom_keys($product->get_id());
						}
						foreach ( $custom_fields as $custom_field ) {
							if ( in_array($custom_field, $custom_field_ignore, true) || strpos($custom_field, '_') === 0 ) {
								continue;
							}
							if ( $product->get_meta($custom_field) ) {
								?>
								<div class="product_info_custom_field">
									<div class="data-item flex items-center">
										<i class="rbb-icon-check-9 pl-[3px]"></i>
										<span class="block ml-4 text-xs font-normal leading-6 text-[color:var(--rbb-general-body-text-color)]">
											<?php echo esc_html($product->get_meta($custom_field)); ?>
										</span>
									</div>
								</div>
							<?php } ?>
						<?php } ?>
					<?php } ?>
				</div>
			<?php } ?>
			<div class="product_button flex mt-4">
				<?php
				if ( $show_add_to_cart ) {
					$args      = [];
					$text_cart = '';
					$icon      = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON);
					if ( 'instock' !== $product->get_stock_status() ) {
						$text_cart = esc_html__('Out of stock', 'automize');
					} else {
						if ( $product instanceof \WC_Product_Variable && $product->get_available_variations() ) {
							$text_cart = esc_html__('Select options', 'automize');
						} else {
							$text_cart = esc_html__('Add to Cart', 'automize');
						}
					}
					if ( $icon ) {
						$args['cart-icon'] = '<div class="add-to-cart-icon relative text-center" data-tooltips="' . $text_cart . '">
						<i class="rbb-icon ' . $icon . '"></i>
						</div>';
					}
					woocommerce_template_loop_add_to_cart($args);
				}
				?>
				<?php
				if ( $show_compare ) {
						echo Tag::compare_button($product); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				?>
					<?php
					if ( $show_quickview ) {
						echo Tag::quick_view_button($product); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
