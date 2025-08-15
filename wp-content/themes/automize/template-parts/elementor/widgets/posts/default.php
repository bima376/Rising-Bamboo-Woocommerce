<?php
/**
 * RisingBambooTheme Package
 *
 * @package RisingBambooTheme
 */

use RisingBambooCore\Core\View;
use RisingBambooTheme\App\App;

if ( count($posts['posts']) ) {
	?>
	<div id="<?php echo esc_attr($id); ?>" class="rbb_posts overflow-hidden <?php echo esc_attr($layout); ?>">
		<div class="2xl:container 2xl:mx-auto mt-2">
			<div class="block_slide">
				<div class="block_slider__content overflow-hidden">
					<div class="uppercase font-bold text-xl mb-[30px] flex items-center md:justify-between justify-center text-white">
						<h2 class="title text-xl"><?php echo wp_kses_post($posts['title']); ?></h2>
						<span class="sub_title text-sm"><?php echo wp_kses_post($sub_title); ?></span>
						<?php
						if ( isset($posts['type']) && 'category' === $posts['type'] ) {
							?>
							<?php
							$cat_count = count($posts['categories']);
							if ( 1 < $cat_count || ( $show_filter && 1 === $cat_count ) ) {
								?>
								<span class="title-of hidden sm:block text-sm uppercase mx-8"><?php echo esc_html__('Of', 'automize'); ?></span>
								<select class="appearance-none"
										data-class="relative inset-0 pl-[30px] pr-14 font-extrabold text-base uppercase cursor-pointer transition-all duration-200 ease-in border-2 rounded-3xl"
										data-ajax='{
										"action": "rbb_get_posts_by_category",
										"order_by" : "<?php echo esc_attr($order_by); ?>",
										"order" : "<?php echo esc_attr($order); ?>",
										"limit" : "<?php echo esc_attr($limit); ?>",
										"show_author" : "<?php echo esc_attr($show_author); ?>",
										"show_date" : "<?php echo esc_attr($show_date); ?>",
										"show_read_more" : "<?php echo esc_attr($show_read_more); ?>"
									}'
								>
									<?php foreach ( $posts['categories'] as $category_id => $category ) { ?>
										<option value="<?php echo esc_attr($category_id); ?>"><?php echo wp_kses_post($category); ?></option>
									<?php } ?>
								</select>
							<?php } ?>
							<?php
						}
						?>

					</div>
					<div class="lg:flex w-full float-left">
						<div class="blog-left lg:w-1/2 lg:pr-[35px]">
							<?php
							$first_post = $posts['posts'][0];
							View::instance()->load(
								'elementor/widgets/posts/fragments/item',
								[
									'_post' => $first_post,
								]
							);
				
							?>
						</div>
						<div class="blog-right lg:mt-0 mt-14 xl:h-[572px] md:h-[500px] h-[460px] overflow-y-auto lg:w-1/2 lg:px-[35px]">
						<?php
						$count = 0;
						foreach ( $posts['posts'] as $_post ) {
							if ( $count >= 1 ) {
								View::instance()->load(
									'elementor/widgets/posts/fragments/item-2',
									[
										'_post' => $_post,
									]
								);
							}
							$count++;
						}
						?>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
