<?php
/**
 * RisingBambooTheme package
 *
 * @package RisingBambooTheme
 */

if ( $testimonials ) {
	?>
	<div class="rbb-testimonial relative <?php echo esc_attr($layout); ?>">
		<?php
		if ( isset($image['url']) && ! empty($image['url']) ) {
			?>
			<div class="text-center mb-5">
				<img class="inline-block" src="<?php echo esc_attr($image['url']); ?>" alt="Testimonials">
			</div>
			<?php
		}
		?>
		<div class="pb-2.5">
			<div class="title_block text-left mb-3.5">
				<h2 class="title text-xl uppercase pb-2"><?php echo esc_html($title); ?></h2>
				<p class="sub_title mb-2"><?php echo esc_html($sub_title); ?></p>
			</div>
			<div class="bg-[#f3f3f3] px-[30px] pt-[30px] pb-[60px] rounded-[10px] overflow-hidden">
				<div class="slick-carousel slick-carousel-center load-item" data-slick='{
					"arrows": <?php echo esc_attr($show_arrows); ?>,
					"dots": <?php echo esc_attr($show_pagination); ?>,
					"autoplay": <?php echo esc_attr($autoplay); ?>,
					"autoplaySpeed": <?php echo esc_attr($autoplay_speed); ?>
				}'>
				<?php
				foreach ( $testimonials as $testimonial ) {
					?>
					<div class="item item-<?php echo esc_attr($testimonial->ID); ?> text-center">
						<div class="item-img relative inline-block">
							<div class="icon-note absolute top-[18px] -left-2 bg-white rounded-full overflow-hidden w-[34px] h-[34px] p-1.5">
								<svg enable-background="new 0 0 24 24" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m4.7 17.7c-1-1.1-1.6-2.3-1.6-4.3 0-3.5 2.5-6.6 6-8.2l.9 1.3c-3.3 1.8-4 4.1-4.2 5.6.5-.3 1.2-.4 1.9-.3 1.8.2 3.2 1.6 3.2 3.5 0 .9-.4 1.8-1 2.5-.7.7-1.5 1-2.5 1-1.1 0-2.1-.5-2.7-1.1zm10 0c-1-1.1-1.6-2.3-1.6-4.3 0-3.5 2.5-6.6 6-8.2l.9 1.3c-3.3 1.8-4 4.1-4.2 5.6.5-.3 1.2-.4 1.9-.3 1.8.2 3.2 1.6 3.2 3.5 0 .9-.4 1.8-1 2.5s-1.5 1-2.5 1c-1.1 0-2.1-.5-2.7-1.1z"/></svg>
							</div>
							<div class="rounded-full w-[100px] h-[100px] inline-block overflow-hidden mt-2.5">
								<?php
								if ( has_post_thumbnail($testimonial) ) {
									echo get_the_post_thumbnail(
										$testimonial,
										'post-thumbnail',
										[
											'class' => 'w-full object-cover !w-[100px] !h-[100px]', 
											'alt'   => esc_attr(get_the_title($testimonial)),
										]
									);
								} else {
									?>
									<img class="object-cover !w-[100px] !h-[100px]" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/dist/images/default-thumbnail.png'); ?>" alt="<?php echo esc_attr__('Default post thumbnail', 'automize'); ?>" >
								<?php } ?>
							</div>
						</div>
						<div class="testimonial_ratings flex justify-center text-base mt-[34px] mb-[14px] text-[#4ea932]">
							<i class="rbb-icon-rating-start-filled-1"></i>
							<i class="rbb-icon-rating-start-filled-1"></i>
							<i class="rbb-icon-rating-start-filled-1"></i>
							<i class="rbb-icon-rating-start-filled-1"></i>
							<i class="rbb-icon-rating-start-filled-1"></i>
						</div>
						<div class="testimonial_text mb-8 line-clamp-[7] relative"><?php echo wp_kses_post($testimonial->post_content); ?></div>
						<div class="block_content-name flex items-center justify-center mb-[30px]">
							<h5 class="testimonial_info text-xs mr-1 text-[#2d2d2d]">
								<?php echo esc_html($testimonial->post_title); ?> -
							</h5>
							<h6 class="testimonial_excerpt text-xs !text-[#666666]"><?php echo wp_kses_post($testimonial->post_excerpt); ?></h6>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php } ?>
