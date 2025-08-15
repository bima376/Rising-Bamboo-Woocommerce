<?php
/**
 * RisingBambooTheme package
 *
 * @package RisingBambooTheme
 */

if ( $testimonials ) {
	?>
	<div class="rbb-testimonial <?php echo esc_attr($layout); ?>">
		<div class="">
			<div class="text-center wow fadeInUp">
				<?php
				if ( isset($image['url']) && ! empty($image['url']) ) { 
					?>
					<img class="inline-block" src="<?php echo esc_attr($image['url']); ?>" alt="Testimonials">
				<?php } ?>
			</div>
			<div class="title_block text-center mb-[51px] wow fadeInUp">
				<p class="sub_title mb-[6px]"><?php echo esc_html($sub_title); ?></p>
				<h2 class="title text-2xl"><?php echo esc_html($title); ?></h2>
			</div>
			<div class="slick-carousel slick-carousel-center wow fadeInUp pb-[50px] load-item-2" data-slick='{
				"arrows": <?php echo esc_attr($show_arrows); ?>,
				"dots": <?php echo esc_attr($show_pagination); ?>,
				"autoplay": <?php echo esc_attr($autoplay); ?>,
				"autoplaySpeed": <?php echo esc_attr($autoplay_speed); ?>,
				"slidesToShow": 2,
				"responsive": [
				{
					"breakpoint": 1199,
					"settings": {
						"slidesToShow": 2
					}
				},
				{
					"breakpoint": 991,
					"settings": {
						"slidesToShow": 1
					}
				},
				{
					"breakpoint": 768,
					"settings": {
						"slidesToShow": 1
					}
				},
				{
					"breakpoint": 480,
					"settings": {
						"slidesToShow": 1
					}
				}
				]
			}'>
			<?php
			foreach ( $testimonials as $testimonial ) {
				?>
				<div class="item px-[15px] relative item-<?php echo esc_attr($testimonial->ID); ?> md:text-left">
					<div class="item-content relative md:flex md:items-center md:justify-center">
						<div class="md:mr-10 md:mb-0 mb-5 md:text-left text-center">
							<div class="rounded-full w-[100px] h-[100px] inline-block relative">
								<div class="icon-note absolute top-[5px] -left-2 bg-white rounded-full overflow-hidden w-[34px] h-[34px] border border-[#eaeaea] p-1.5">
									<svg enable-background="new 0 0 24 24" height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m4.7 17.7c-1-1.1-1.6-2.3-1.6-4.3 0-3.5 2.5-6.6 6-8.2l.9 1.3c-3.3 1.8-4 4.1-4.2 5.6.5-.3 1.2-.4 1.9-.3 1.8.2 3.2 1.6 3.2 3.5 0 .9-.4 1.8-1 2.5-.7.7-1.5 1-2.5 1-1.1 0-2.1-.5-2.7-1.1zm10 0c-1-1.1-1.6-2.3-1.6-4.3 0-3.5 2.5-6.6 6-8.2l.9 1.3c-3.3 1.8-4 4.1-4.2 5.6.5-.3 1.2-.4 1.9-.3 1.8.2 3.2 1.6 3.2 3.5 0 .9-.4 1.8-1 2.5s-1.5 1-2.5 1c-1.1 0-2.1-.5-2.7-1.1z"/></svg>
								</div>
								<div class="rounded-full overflow-hidden">
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
						</div>
						<div class="md:text-left bg-[#f3f3f3] relative text-center p-10 rounded-[10px] before:content-[''] before:absolute before:h-0 before:-left-[22px] before:top-1/2 before:-translate-y-1/2 before:border-y-[25px] before:border-r-[22px] before:border-y-transparent before:border-r-[#f3f3f3] md:before:block before:hidden">
							<div class="testimonial_ratings flex md:justify-start justify-center text-base mb-[14px] text-[#ffe200]">
								<i class="rbb-icon-rating-start-filled-2 mx-[1px]"></i>
								<i class="rbb-icon-rating-start-filled-2 mx-[1px]"></i>
								<i class="rbb-icon-rating-start-filled-2 mx-[1px]"></i>
								<i class="rbb-icon-rating-start-filled-2 mx-[1px]"></i>
								<i class="rbb-icon-rating-start-filled-2 mx-[1px]"></i>
							</div>
							<div class="content mb-[21px] relative"><?php echo wp_kses_post($testimonial->post_content); ?></div>
							<div class="block_content-name flex items-center md:justify-start justify-center">
								<h5 class="testimonial_info text-xs mr-1 text-[#2d2d2d]">
									<?php echo esc_html($testimonial->post_title); ?> -
								</h5>
								<h6 class="testimonial_excerpt text-xs !text-[#666666]"><?php echo wp_kses_post($testimonial->post_excerpt); ?></h6>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>
