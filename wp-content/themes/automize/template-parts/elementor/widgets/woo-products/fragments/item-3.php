<?php
/**
 * Elementor widget : woo-product.
 *
 * @package RisingBambooTheme
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Helper\Setting;
use RisingBambooTheme\Helper\Tag;
$product_images = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGES_SHOW);
$effect_images  = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGE_EFFECT);
?>
<div class="item">
	<div class="item-product relative border rounded-[9px] bg-white md:flex justify-left items-center">
		<?php if ( $show_wishlist ) { ?>
			<div class="absolute md:top-4 z-10 top-3 md:right-4 right-3">
				<?php echo Tag::wish_list_button($product); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		<?php } ?>
		<div class="md:w-1/2 2xl:max-w-[203px] xl:max-w-[192px] max-w-[214px] thumbnail-container md:static relative
		<?php 
		echo esc_attr($effect_images);
		echo esc_attr(( true === $product_images ) && \RisingBambooCore\Helper\Woocommerce::get_gallery_image($product, [ 600, 600 ]) ? ' hover-images ' : ' none-hover-images ');
		?>
		">
		<a class="relative block rounded-[18px] overflow-hidden" href="<?php echo esc_url($product->get_permalink()); ?>">
			<?php
			echo wp_kses(
				$product->get_image(
					[ 600, 600 ],
					[
						'class' => 'max-w-full w-full',
						'alt'   => esc_attr($product->get_name()),
					]
				),
				'rbb-kses'
			);
			if ( \RisingBambooCore\Helper\Woocommerce::get_gallery_image($product, [ 600, 600 ]) ) {
				$second_image = \RisingBambooCore\Helper\Woocommerce::get_gallery_image($product, [ 600, 600 ])[0];
				?>
				<img class="max-w-full image-cover absolute left-0 top-0 opacity-0" src="<?php echo esc_url($second_image->src); ?>" alt="<?php echo esc_attr__('Second image of ', 'automize') . esc_attr($product->get_name()); ?>"/>
				<?php
			}
			?>
		</a>
		<div class="product-flags absolute md:left-4 left-3 md:top-5 top-3 z-10 font-semibold text-[11px]">
			<?php if ( $product->is_featured() && 'instock' === $product->get_stock_status() ) { ?>
				<label class="bg-[#66ad53] text-white font-bold py-[5px] leading-[18px] px-[13px] text-[10px] h-[26px] rounded-[26px] block mb-2.5 uppercase text-center min-w-[66px]"><?php echo esc_html__('New', 'automize'); ?>
			</label>
		<?php } ?>
		<?php if ( 'instock' !== $product->get_stock_status() ) { ?>
			<label class="bg-[#66ad53] text-white font-bold py-[5px] px-[13px] leading-[18px] text-[10px] h-[26px] rounded-[26px] block mb-2.5 uppercase text-center min-w-[66px]"><?php echo esc_html__('Sold out', 'automize'); ?>
		</label>
	<?php } ?>
</div>
<?php
$countdown_date_to = $product->get_date_on_sale_to();
if ( $show_countdown && $countdown_date_to ) {
	$current_date         = new \WC_DateTime();
	$countdown_date_start = $product->get_date_on_sale_from() ?? $product->get_date_modified();
	if ( ( $current_date >= $countdown_date_start ) && ( $current_date <= $countdown_date_to ) ) {
		?>
		<div class="item-countdown absolute md:inset-x-[30px] inset-x-1 md:top-[5px] md:bottom-auto  bottom-[5px] duration-300 z-50">
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
<div class="md:w-1/2 md:py-4 pt-4 pb-6 md:px-3 product_info relative overflow-hidden">
	<div class="product_info-bottom bg-white pt-3 md:px-0 px-3">
		<?php if ( $show_rating ) { ?>
			<div class="product_ratting text-amber-400 flex items-center mb-3.5">
				<?php echo wc_get_rating_html($product->get_average_rating()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span class="ratting-count text-[#5e5e5e] font-medium ml-1 text-[10px]">(<?php echo esc_html($product->get_rating_count()); ?>)</span>
			</div>
		<?php } ?>
		<a href="<?php echo esc_url($product->get_permalink()); ?>" class="product_name block md:text-base text-[0.8125rem] !font-semibold md:mb-5 mb-2"><span class="line-clamp-2"><?php echo wp_kses_post($product->get_name()); ?></span></a>
		<div class="product_price text-sm font-extrabold overflow-hidden">
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
		<?php if ( $show_stock || $show_custom_field ) { ?>
				<div class="group-custom-field pt-4">
					<?php if ( $show_stock ) { ?>
						<div class="stock-content mb-1 text-xs font-normal leading-6">
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
	</div>
	<div class="product-groups z-10 w-full md:bottom-0 bottom-2 left-3 opacity-0 absolute duration-300">
		<div class="flex relative bg-white rounded-br-[20px]">
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
