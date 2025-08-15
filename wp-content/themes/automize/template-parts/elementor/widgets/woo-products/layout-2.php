<?php
/**
 * RisingBambooTheme Package
 *
 * @package RisingBambooTheme
 */

use RisingBambooCore\Core\View;
use RisingBambooTheme\App\App;

/**
 * Use for woocommerce_template_loop_add_to_cart func.
 */
global $product;
if ( count($data['products']) ) {

	$bg_image_default = esc_url(RBB_THEME_DIST_URI . 'images/elementor/widgets/products/category-default.jpg');
	$category_link    = '';
	if ( 'category' === $data['type'] ) {
		$first_category_fetched = false;
		foreach ( $data['categories'] as $category_id => $category ) {
			$term_data = get_term($category_id, 'product_cat');
			if ( $term_data && ! is_wp_error($term_data) ) {
				$category_name      = esc_html($term_data->name);
				$category_link2     = esc_url(get_term_link($term_data));
				$category_image_url = get_term_meta($category_id, 'thumbnail_id', true);
				$category_image_url = wp_get_attachment_url($category_image_url);
				if ( ! is_wp_error($category_link2) ) {
					if ( ! $first_category_fetched ) {
						$category_link          = $category_link2;
						$first_category_fetched = true; 
					}
					if ( ! empty($category_image_url) ) {
						$bg_image_default = $category_image_url;
					}
				}
			}
		}
	}

	?>
	<div id="<?php echo esc_attr($id); ?>" class="rbb_woo_products <?php echo esc_attr($layout); ?>">
		<?php if ( ! empty($surrounding_animation_image_01['url']) ) { ?>
			<div class="absolute top-0 left-[3%] md:block hidden z-10 animate-[iconbanner_3s_linear_infinite]">
				<img class="xl:w-full w-1/2" src="<?php echo esc_url($surrounding_animation_image_01['url']); ?>" alt="bg right" >
			</div>
		<?php } ?>
		<?php if ( ! empty($surrounding_animation_image_02['url']) ) { ?>
			<div class="absolute top-0 right-[3%] md:block hidden z-10 animate-[iconbanner_3s_linear_infinite]">
				<img class="xl:w-full w-1/2" src="<?php echo esc_url($surrounding_animation_image_02); ?>" alt="bg right" >
			</div>
		<?php } ?>
		<div class="2xl:container px-[15px] mx-auto">
			<div class="<?php echo ( 'category' === $data['type'] ) ? 'md:flex lg:gap-[30px] gap-[20px]' : 'w-full'; ?>">
				<?php if ( 'category' === $data['type'] ) { ?>
				<div class="title_left group lg:w-1/3 md:w-[42%] w-full lg:mt-[15px] mt-[7px]">
					<div class="xl:relative sticky top-0 inline-block">
						<div class="text-center relative overflow-hidden">
							<div class="absolute grid z-10 inset-0 xl:px-[70px] px-6 xl:pt-[92px] pt-10 pb-10">
							<?php if ( $show_title ) { ?>
							<div class="border-title relative md:mb-0 mb-4 ">
								<h2 class="title uppercase"><?php echo wp_kses_post($data['title']); ?></h2>
								<span class="sub-title block mt-5"><?php echo wp_kses_post($subtitle); ?></span>
							</div>
							<?php } ?>
								<?php
								$cat_count = count($data['categories']);
								if ( '1' < $cat_count || ( $show_filter && '1' === $cat_count ) ) {
									?>
									<select class="appearance-none"
											data-class="relative inset-0 px-[30px] font-extrabold text-base uppercase cursor-pointer transition-all duration-200 ease-in border-2 rounded-3xl"
											data-ajax='{
												"action": "rbb_get_products_by_category",
												"fragment": "item-5",
												"order_by" : "<?php echo esc_attr($order_by); ?>",
												"order" : "<?php echo esc_attr($order); ?>",
												"limit" : "<?php echo esc_attr($limit); ?>",
												"show_wishlist" : <?php echo esc_attr(( $show_wishlist ) ? '1' : '0'); ?>,
												"show_rating" : <?php echo esc_attr(( $show_rating ) ? '1' : '0'); ?>,
												"show_quickview" : <?php echo esc_attr(( $show_quickview ) ? '1' : '0'); ?>,
												"show_compare" : <?php echo esc_attr(( $show_compare ) ? '1' : '0'); ?>,
												"show_add_to_cart" : <?php echo esc_attr(( $show_add_to_cart ) ? '1' : '0'); ?>
												"show_countdown" : <?php echo esc_attr(( $show_countdown ) ? '1' : '0'); ?>,
												"show_percentage_discount" : <?php echo esc_attr(( $show_percentage_discount ) ? '1' : '0'); ?>,
												"show_stock" : <?php echo esc_attr(( $show_stock ) ? '1' : '0'); ?>,
												"show_custom_field" : <?php echo esc_attr(( $show_custom_field ) ? '1' : '0'); ?>,
												"custom_fields" : <?php echo wp_json_encode($custom_fields); ?>,
												"custom_field_ignore" : <?php echo wp_json_encode($custom_field_ignore); ?>
											}'
									>
										<?php foreach ( $data['categories'] as $category_id => $category ) { ?>
											<option value="<?php echo esc_attr($category_id); ?>"><?php echo wp_kses_post($category); ?></option>
										<?php } ?>
									</select>
								<?php } ?>
							<div class="mt-auto mb-0">
								<a class="rbb-button button !bg-white !text-[color:var(--rbb-general-button-color)] hover:!text-[color:var(--rbb-general-button-hover-color)] hover:!bg-[color:var(--rbb-general-button-bg-hover-color)] inline-block btn h-[50px] leading-[50px] rounded-[50px] min-w-[140px]" href="<?php echo esc_url($category_link); ?>">
									<?php echo esc_html__('Shop Now', 'automize'); ?>
								</a>
						</div>
						</div>
						<?php if ( $show_arrows ) { ?>
							<div class="arrow-custom block_btn md:flex hidden mt-1">
								<span class="prev_custom mr-4 md:w-[53px] md:h-[53px] md:leading-[53px] w-10 h-10 leading-10 text-lg text-center rounded-full cursor-pointer"><i
											class="rbb-icon-direction-36"></i></span>
								<span class="next_custom md:w-[53px] md:h-[53px] md:leading-[53px] w-10 h-10 leading-10 text-lg text-center rounded-full cursor-pointer"><i
											class="rbb-icon-direction-39"></i></span>
							</div>
						<?php } ?>
						<div class="overflow-hidden max-h-[728px] rounded-lg">
						<img class="img-fluid w-full group-hover:scale-105 duration-300" src="<?php echo esc_url($bg_image_default); ?>" alt="category">
					</div>
				</div>
					</div>
				</div>
				<?php } else { ?>
					<div class="title_left flex pb-5">
						<div class="h-full flex items-center flex-col">
							<?php if ( $show_title ) { ?>
							<div class="text-left">
								<h2 class="title uppercase whitespace-nowrap"><?php echo wp_kses_post($data['title']); ?></h2>
								<span class="sub-title block mt-3"><?php echo wp_kses_post($subtitle); ?></span>
							</div>
							<?php } ?>
						</div>
						<?php if ( $show_arrows ) { ?>
							<div class="arrow-custom block_btn md:flex hidden mt-1">
								<span class="prev_custom mr-4 md:w-[53px] md:h-[53px] md:leading-[53px] w-10 h-10 leading-10 text-lg text-center rounded-full cursor-pointer"><i
											class="rbb-icon-direction-36"></i></span>
								<span class="next_custom md:w-[53px] md:h-[53px] md:leading-[53px] w-10 h-10 leading-10 text-lg text-center rounded-full cursor-pointer"><i
											class="rbb-icon-direction-39"></i></span>
							</div>
						<?php } ?>
				</div>
				<?php } ?>
				<div class="md:mt-0 mt-[30px] <?php echo esc_attr('category' === $data['type']) ? 'lg:w-2/3 md:w-[58%] w-full' : ' w-full'; ?> ">
						<div class="rbb-slick-carousel slick-carousel slick-carousel-center" data-slick='{
							"arrows": <?php echo esc_attr($show_arrows) ? 'true' : 'false'; ?>,
							"appendArrows" : "#<?php echo esc_attr($id); ?> .arrow-custom",
							"prevArrow": "#<?php echo esc_attr($id); ?> .arrow-custom .prev_custom",
							"nextArrow": "#<?php echo esc_attr($id); ?> .arrow-custom .next_custom",
							"dots": <?php echo esc_attr($show_pagination) ? 'true' : 'false'; ?>,
							"autoplay": <?php echo esc_attr($autoplay) ? 'true' : 'false'; ?>,
							"autoplaySpeed": <?php echo esc_attr($autoplay_speed); ?>,
							"pauseOnFocus": <?php echo esc_attr($autoplay_pause) ? 'true' : 'false'; ?>,
							"pauseOnHover": <?php echo esc_attr($autoplay_pause) ? 'true' : 'false'; ?>,
							"rows": <?php echo esc_attr($row); ?>,
							"slidesPerRow" : <?php echo esc_attr($slides_per_row); ?>,
							<?php
							$i     = 1;
							$count = count($active_break_points);
							if ( $count ) {
								?>
							"responsive": [
								<?php
								foreach ( $active_break_points as $name => $break_point ) {
									$sliders_per_row_bp = ( $widget->get_value_setting('general_layout_slides_per_row_' . $name) ) ? ceil(abs($widget->get_value_setting('general_layout_slides_per_row_' . $name)['size'])) : $slides_per_row;
									?>
								{
									"breakpoint": <?php echo esc_attr($break_point->get_value()); ?>,
									"settings": {
										"slidesPerRow": <?php echo esc_attr($sliders_per_row_bp); ?>
									}
								}
									<?php
									if ( $i < $count ) {
										echo ',';
									}
									$i++;
								}
								?>
								]
								<?php } ?>
							}'
						>
							<?php
							foreach ( $data['products'] as $product ) {
								View::instance()->load(
									'elementor/widgets/woo-products/fragments/item-2',
									[
										'product' => $product,
									]
								);
							}
							?>
						</div>
					</div>
			</div>
		</div>
	</div>
	<?php
}
?>
