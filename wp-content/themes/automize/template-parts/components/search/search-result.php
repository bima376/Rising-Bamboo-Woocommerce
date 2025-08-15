<?php
/**
 * RisingBambooTheme.
 *
 * @package RisingBambooTheme.
 */

use RisingBambooTheme\Helper\Helper;
use RisingBambooTheme\App\App;
use RisingBambooTheme\Helper\Setting;
$search_overlay = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_OVERLAY);
$header         = Setting::get(RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER);
?>

<div class="rbb_results fixed z-[999] opacity-0 invisible inset-x-0 bg-white <?php echo ( 'header-02' === $header ) ? 'pt-[31px] !z-10' : ''; ?>">
	<div class="rbb-search-result-wrap mx-auto md:pt-9 pt-6 px-[15px] md:pb-11 bg-white <?php echo esc_attr(( $search_overlay ) ? '' : '2xl:w-[1500px] md:rounded-lg'); ?>">
		<?php if ( ! empty(Helper::get_popular_keyword()) ) { ?>
			<div class="text-[11px] font-bold uppercase"><?php echo esc_html__('Popular Search:', 'automize'); ?></div>
			<ul class="rbb-search-popular pt-3 overflow-x-auto md:flex text-black capitalize text-[0.625rem] leading-[34px]">
				<?php foreach ( Helper::get_popular_keyword() as $keyword ) { ?>
					<li class="h-[34px] float-left inline-block mt-[5px] md:px-6 px-5 md:rounded-[34px] rounded-[2px] mr-[5px] hover:text-white cursor-pointer duration-300 bg-[#eaeaea] hover:bg-[color:var(--rbb-general-secondary-color)]"><?php echo wp_kses_post($keyword); ?></li>
					<?php
				}
				?>
			</ul>
		<?php } ?>
		<div class="rbb-search-result flex-grow relative md:pt-7 py-5">
			<div class="rbb-spinner absolute invisible inset-2/4 ease-linear h-5 w-10"></div>
			<div class="rbb-search-result-ajax">
				<div class="no-result w-full text-xl text-center md:grid-cols-12 md:grid-cols-11 md:grid-cols-10 md:grid-cols-9 md:grid-cols-8 md:grid-cols-7 md:grid-cols-6 md:grid-cols-5 md:grid-cols-4 md:grid-cols-2"></div>
				<div class="result grid md:grid-cols-<?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_RESULT_COLUMN)); ?> grid-cols-2 grid-flow-row md:gap-[30px] gap-[15px] overflow-y-auto"></div>
			</div>
		</div>
	</div>
	<?php if ( true !== $search_overlay ) { ?>
		<div class="button-close-search absolute right-5 top-auto bottom-5 h-10 md:inline-block hidden">
			<div class="close-search duration-300 bg-[#ebebeb] hover:bg-[color:var(--rbb-general-primary-color)] text-black hover:text-white relative mx-auto w-10 h-10 rounded-full text-center leading-10 cursor-pointer">✕
			</div>
		</div>
	<?php } ?>
</div>
