<?php
/**
 * Elementor widget
 *
 * @package RisingBambooTheme
 */

use RisingBambooTheme\App\App;

?>
<div class="item">
	<div class="blog_item group border-b-[1px] border-[#efefef] mb-[30px] xl:mr-[25px] pb-[30px] flex items-start">
		<div class="blog_image rounded-[10px] overflow-hidden md:mr-[30px] mr-5">
			<a href="<?php echo esc_url(get_permalink($_post)); ?>" class="md:w-[200px]">
				<?php
				if ( has_post_thumbnail($_post) ) {
					echo get_the_post_thumbnail(
						$_post,
						'post-thumbnail',
						[
							'class' => 'w-full object-cover md:!max-w-[200px] xl:min-h-[150px] duration-300 scale-100 group-hover:scale-105',
							'alt'   => esc_attr(get_the_title($_post)),
						]
					);
				} else {
					?>
					<img class="object-cover md:!max-w-[200px] xl:min-h-[150px] duration-300 scale-100 group-hover:scale-105"
						src="<?php echo esc_url(get_stylesheet_directory_uri() . '/dist/images/default-thumbnail.png'); ?>"
						alt="<?php echo esc_attr__('Default post thumbnail', 'automize'); ?>">
					<?php
				}
				?>
			</a>
		</div>
		<div class="blog_info md:flex-1">
			<div class="blog_meta flex items-center font-semibold text-xs mb-2">
				<?php if ( $show_author ) { ?>
					<div class="blog_author mr-[45px] !text-[#666666]">
						<i class="rbb-icon-human-user-10 text-[13px] mr-2 text-[#c9c9c9]"></i>
						<span><?php echo esc_html__('By ', 'automize'); ?><?php echo esc_html(get_the_author_meta('display_name', $_post->post_author)); ?></span>
					</div>
				<?php } ?>
				<div class="blog_date">
					<i class="rbb-icon-calendar-1 align-text-top leading-3 text-[22px] mr-2 text-[#c9c9c9]"></i>
					<span><?php echo esc_html(get_the_date('dS M Y', $_post)); ?></span>
				</div>
			</div>
			<a href="<?php echo esc_url(get_permalink($_post)); ?>" class="blog_title line-clamp-2 !font-semibold leading-[26px]"><?php echo esc_html(get_the_title($_post)); ?></a>
			<div class="content md:inline-block hidden line-clamp-2 pt-4">
				<?php echo esc_html(wp_trim_words(get_the_content(null, false, $_post->ID), 18, '...')); ?>	
			</div>
		</div>
	</div>
</div>
