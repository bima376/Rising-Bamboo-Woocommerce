<?php
/**
 * RisingBambooTheme
 *
 * @package RisingBambooTheme.
 * @version 1.0.0
 * @since 1.0.0
 */

use RisingBambooTheme\Helper\Setting;
?>

<div class="scroll-to-top rounded-full fixed z-10 md:block hidden cursor-pointer opacity-0 bottom-5 right-5 p-3">
	<span class="text-[length:var(--rbb-scroll-top-icon-size)] text-[color:var(--rbb-scroll-top-icon-color)] <?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SCROLL_TO_TOP_ICON)); ?>"></span>
	<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
	<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
	</svg>
</div>
