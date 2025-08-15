<?php
/**
 * Elementor widget : woo-product.
 *
 * @package RisingBambooTheme
 */

use RisingBambooCore\App\App;
use RisingBambooTheme\Helper\Setting;
use RisingBambooTheme\Helper\Tag;

?>
<div class="relative overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
	<?php if ( ! empty($image) ) : ?>
		<img loading="lazy" class="w-full h-auto object-cover" src="<?php echo esc_url($image); ?>" alt="<?php echo ! empty($title) ? esc_attr($title) : ''; ?>" />
	<?php endif; ?>

	<div class="p-4 bg-white">
		<?php if ( ! empty($title) ) : ?>
			<h2 class="text-xl font-bold text-gray-800 mb-2"><?php echo esc_html($title); ?></h2>
		<?php endif; ?>

		<?php if ( ! empty($subtitle) ) : ?>
			<h3 class="text-md font-medium text-gray-600 mb-3"><?php echo esc_html($subtitle); ?></h3>
		<?php endif; ?>

		<?php if ( ! empty($description) ) : ?>
		<p class="text-gray-500 text-sm"><?php echo wp_kses_post($description); ?></p>
		<?php endif; ?>
	</div>
</div>
