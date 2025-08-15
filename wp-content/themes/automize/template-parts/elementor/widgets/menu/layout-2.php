<?php
/**
 * Default template.
 *
 * @package RisingBambooCore.
 */

?>

<div id="desktop-elementor-vertical_menu" class="rbb-elementor-menu-layout2 rbb-elementor-vertical-menu vertical-menu relative z-50">
	<div class="vertical-menu-title flex items-center bg-[#070d12] text-white text-xs">
		<i class="rbb-icon-menu-6 text-2xl w-[50px] h-[58px] leading-[58px] text-center"></i>
		<h6 class="px-[15px] py-2.5 text-xs text-white"><?php echo wp_kses_post($title); ?></h6>
	</div>
<?php
// override params https://developer.wordpress.org/reference/functions/wp_nav_menu/ .
$override_args = [
	'theme_location' => 'vertical',
];
$args          = wp_parse_args($override_args, $args);
wp_nav_menu($args);
?>

</div>
