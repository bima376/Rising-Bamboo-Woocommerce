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
		<div class="container mx-auto">
					<div class="title_left flex">
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
				<div class="md:mt-0 mt-2.5">
						<div class="rbb-slick-carousel slick-carousel slick-carousel-center load-item-<?php echo esc_attr($slides_per_row); ?>" data-slick='{
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
	<?php
}
?>
