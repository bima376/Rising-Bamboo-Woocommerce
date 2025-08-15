<?php
/**
 * Contact shortcode template.
 *
 * @package RisingBambooCore
 */

?>

<?php if ( $data ) : ?>
<div class="flex items-center content <?php echo esc_attr('rbb_contact_shortcode_' . $type); ?>">
	<i class="<?php echo esc_attr($icon); ?>"></i>
	<p class="pl-1 mb-0"><?php echo wp_kses_post($data); ?></p>
</div>
<?php endif; ?>
