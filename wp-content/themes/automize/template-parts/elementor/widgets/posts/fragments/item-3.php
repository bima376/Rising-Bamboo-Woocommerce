<?php
/**
 * Elementor widget
 *
 * @package RisingBambooTheme
 */

use RisingBambooTheme\App\App;
?>
<div class="item basis-0 grow">
	<div class="blog_item group">
		<div class="blog_image mb-[18px] rounded-[10px] overflow-hidden mb-[26px]">
			<a href="<?php echo esc_url(get_permalink($_post)); ?>" class="w-full">
				<?php
				if ( has_post_thumbnail($_post) ) {
					echo get_the_post_thumbnail(
						$_post,
						'post-thumbnail',
						[
							'class' => 'w-full duration-300 scale-100 group-hover:scale-105',
							'alt'   => esc_attr(get_the_title($_post)),
						]
					);
				} else {
					?>
					<img class="duration-300 scale-100 group-hover:scale-105"
						src="<?php echo esc_url(get_stylesheet_directory_uri() . '/dist/images/default-thumbnail.png'); ?>"
						alt="<?php echo esc_attr__('Default post thumbnail', 'automize'); ?>">
					<?php
				}
				?>
			</a>
		</div>
		<div class="blog_info mb-[23px]">
			<div class="blog_meta flex justify-between font-bold text-xs uppercase text-[#cdcdcd]">
				<div class="blog_category mr-[45px]">
					<?php
					$categories = get_the_category($_post->ID);
					if ( ! empty($categories) ) {
						echo esc_html($categories[0]->name);
					}
					?>
				</div>
				<?php if ( $show_author ) { ?>
					<div class="blog_author">
						<i class="rbb-icon-human-user-10 text-[13px] mr-2 text-[#c9c9c9]"></i>
						<span><?php echo esc_html__('By ', 'automize'); ?><?php echo esc_html(get_the_author_meta('display_name', $_post->post_author)); ?></span>
					</div>
				<?php } ?>
			</div>
			<a href="<?php echo esc_url(get_permalink($_post)); ?>" class="blog_title font-bold text-lg mt-2 block leading-[26px]">
				<span class="line-clamp-2"><?php echo esc_html(get_the_title($_post)); ?></span>
			</a>
			<div class="content line-clamp-3 pt-4">
				<?php echo esc_html(wp_trim_words(get_the_content(null, false, $_post->ID), 18, '...')); ?>
			</div>
			<?php if ( $show_read_more || $show_date ) { ?>
				<div class="content-buttom flex justify-between text-xs border-t-[1px] border-[#e5e5e5] mt-6 pt-5">
				<?php if ( $show_read_more ) { ?>
					<a href="<?php echo esc_url(get_permalink($_post)); ?>" class="blog_readmore font-semibold flex items-center">
						<span class="mr-1.5 relative"><?php echo esc_html__('Read More', 'automize'); ?></span>
						<i class="rbb-icon-direction-711 relative text-sm"></i></a>
				<?php } ?>
				<?php if ( $show_date ) { ?>
					<div class="blog_date text-[#666]">
						<span><?php echo esc_html(get_the_date('dS M Y', $_post)); ?></span>
					</div>
				<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
