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
			<div class="mb-[22px] text-center wow fadeInUp">
				<?php
				if ( isset($image['url']) && ! empty($image['url']) ) { 
					?>
					<img class="inline-block" src="<?php echo esc_attr($image['url']); ?>" alt="Testimonials">
				<?php } ?>
			</div>
			<div class="title_block text-center mb-11 wow fadeInUp">
				<p class="sub_title mb-[6px]"><?php echo esc_html($sub_title); ?></p>
				<h2 class="title md:text-[40px] text-3xl"><?php echo esc_html($title); ?></h2>
			</div>
			<div class="slick-carousel slick-carousel-center wow fadeInUp pb-[50px] load-item-3" data-slick='{
				"arrows": <?php echo esc_attr($show_arrows); ?>,
				"dots": <?php echo esc_attr($show_pagination); ?>,
				"autoplay": <?php echo esc_attr($autoplay); ?>,
				"autoplaySpeed": <?php echo esc_attr($autoplay_speed); ?>,
				"slidesToShow": 3,
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
						"slidesToShow": 2
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
					<div class="item-content relative md:flex md:justify-self-end">
						<div class="content-avatar md:mr-[30px] md:text-left text-center">
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
						<div class="md:text-left text-center md:pt-0 pt-5">
							<div class="testimonial_ratings flex md:justify-start justify-center text-base mb-[14px] text-[#ffe200]">
								<i class="rbb-icon-rating-start-filled-2 mx-[1px]"></i>
								<i class="rbb-icon-rating-start-filled-2 mx-[1px]"></i>
								<i class="rbb-icon-rating-start-filled-2 mx-[1px]"></i>
								<i class="rbb-icon-rating-start-filled-2 mx-[1px]"></i>
								<i class="rbb-icon-rating-start-filled-2 mx-[1px]"></i>
							</div>
							<div class="testimonial_text mb-[18px] relative"><?php echo wp_kses_post($testimonial->post_content); ?></div>
							<div class="block_content-name flex items-center md:justify-start justify-center">
								<div class="testimonial_info mr-1 text-xs text-[#2d2d2d]">
									<?php echo esc_html($testimonial->post_title); ?> -
								</div>
								<div class="testimonial_excerpt text-xs font-bold text-[#cdcdcd]"> <?php echo wp_kses_post($testimonial->post_excerpt); ?></div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>
