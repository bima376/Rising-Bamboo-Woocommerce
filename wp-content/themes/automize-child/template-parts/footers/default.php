<?php
/**
 * The default footer.
 *
 * @package Rising_Bamboo
 */

use RisingBambooTheme\App\App;

?>

<footer id="colophon" class="site-footer container mx-auto py-5">
	<div class="site-info">
		<a href="<?php echo esc_url(__('https://wordpress.org/', 'automize')); ?>">
			<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf(esc_html__('Proudly powered by %s', 'automize'), 'WordPress');
			?>
		</a>
		<span class="sep"> | </span>
		<?php
		/* translators: 1: Theme author. */
		printf(esc_html__('© Copyright : %1$s', 'automize'), '<a href="https://risingbamboo.com">Rising Bamboo</a>'); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->
