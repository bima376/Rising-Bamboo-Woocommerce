<?php
/**
 * The default header.
 *
 * @package Rising_Bamboo
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Helper\Helper;
use RisingBambooTheme\Helper\Setting;
use RisingBambooTheme\Helper\Tag;
use RisingBambooTheme\App\Menu\Menu;
use RisingBambooTheme\Woocommerce\Woocommerce as RisingBambooWoo;
$modal_effect    = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_EFFECT);
$outside         = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_CLICK_OUTSIDE_CLOSE);
$backdrop_filter = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER);
$classes         = [ 'account-form-popup rbb-modal invisible fixed inset-0 z-50 ' ];
$classes[]       = ( true === $backdrop_filter ) ? 'backdrop' : 'backdrop-none';
$classes[]       = ( false === $outside ) ? 'outside-modal' : '';
$class_string    = implode(' ', array_filter($classes));
?>
<header id="rbb-default-header" class="rbb-default-header header-6 w-full md:h-[155px] relative z-[1000]">
	<div class="2xl:container header-top hidden md:!grid grid-cols-5 2xl:mx-auto mx-[15px] h-[65px]">
		<div class="header-top-left col-span-3 flex items-center">
			<?php
			$sidebar_active = is_active_sidebar('sidebar-header3-top');
			if ( $sidebar_active ) {
				dynamic_sidebar('sidebar-header3-top'); }
			?>
		</div>
		<div class="col-span-2 flex justify-self-end items-center">
			<?php 
			if ( Helper::show_login_form() || Helper::show_wishlist() ) {
				if ( Helper::show_login_form() ) { 
					?>
				<div class="rbb-account min-h-[65px] relative md:flex hidden items-center justify-center mr-3.5
					<?php echo ( false === is_user_logged_in() && true === Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_POPUP) ) ? 'popup-account' : 'toggle-login'; ?> "
								<?php
								if ( false === is_user_logged_in() && true === Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_POPUP) ) {
									?>
									onclick="RisingBambooModal.modal('.account-form-popup', event)" <?php } ?>
									>
									<div class="rbb-account-icon-wrap cursor-pointer flex items-center">
										<span class="rbb-account-icon duration-300 <?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_ICON)); ?>"></span>
										<span class="whitespace-nowrap text-[0.75rem] pl-2.5 text-white"><?php echo esc_html__('Account', 'automize'); ?></span>
									</div>
									<div class="rbb-account-content-wrap">
										<?php
										$content = '';
										if ( false === is_user_logged_in() && true === Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_POPUP) ) {
											$welcome = __('Account', 'automize');
											if ( Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_POPUP) ) {
												add_action(
													'wp_footer',
													function () use ( $modal_effect, $class_string ) {
                                                   // phpcs:ignore
                                                       echo '<div class="' . esc_attr($class_string) . '" data-modal-animation="' . esc_attr($modal_effect) . '">' . Tag::login_form() . '</div>';
													}
												);
											}
										} else {
											$content = Menu::account_menu();
											if ( ! empty($content) ) {
												?>
											<div class="rbb-account-content duration-300 mt-14 absolute z-10 visibility invisible rounded-lg overflow-hidden opacity-0 top-full right-0 shadow-[6px_5px_11px_rgba(0,0,0,0.1)]">
												<div class="relative bg-white min-w-[220px] px-8 pt-3 pb-5">
													<?php echo wp_kses($content, 'rbb-kses'); ?>
												</div>
											</div>
												<?php
											} 
										}
										?>
									</div>
				</div>
			<?php } ?>
				<?php if ( Helper::show_wishlist() ) { ?>
				<div class="rbb-wishlist md:flex hidden items-center justify-center">
					<div class="relative">
						<a class="wishlist-icon-link duration-300 h-[50px] w-[50px] flex items-center justify-center text-center" href="<?php echo esc_url(WPcleverWoosw::get_url()); ?>">
							<span class="wishlist-icon <?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON)); ?>"></span>
						</a>
						<span class="wishlist-count text-center font-semibold rounded-full"><?php echo WPcleverWoosw::get_count(); // phpcs:ignore ?></span>
					</div>
					<span class="text-white text-xs"><?php echo esc_html__('Wishlist', 'automize'); ?></span>
				</div>
			<?php } ?>
			<?php } ?>
		</div>
	</div>
	<div class="rbb-header-sticky relative md:h-[90px] md:block hidden">
		<div class="2xl:container h-full 2xl:mx-auto mx-[15px]">
			<div class="header-inner h-full bg-white rounded">
				<div class="flex flex-nowrap items-center justify-between h-full grid xl:grid-cols-4 md:grid-cols-9">
					<?php
					if ( Helper::show_logo() ) {
						?>
						<div id="rbb-branding" class="rbb-branding xl:col-span-1 lg:col-span-3 md:col-span-5 flex items-center rbb-header-left">
							<div class="rbb-elementor-menu relative z-10"></div>
							<div id="_desktop_logo" class="inline-flex xl:pl-10">
								<a class="inline-block md:max-w-[197px] max-w-[160px]" href="<?php echo esc_url(home_url()); ?>">
									<?php
									$logo        = Tag::get_logo_uri();
									$logo_sticky = Tag::get_logo_uri('sticky');
									if ( $logo === $logo_sticky ) {
										?>
										<img class="logo" src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr__('logo', 'automize'); ?>">
										<?php
									} else {
										?>
										<img class="sticky-logo" src="<?php echo esc_url($logo_sticky); ?>" alt="<?php echo esc_attr__('Sticky Logo', 'automize'); ?>">
										<img class="logo" src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr__('logo', 'automize'); ?>">
									<?php } ?>
								</a>
							</div>
							<div class="lg:hidden items-center flex">
								<span class="toggle-megamenu relative ml-7 cursor-pointer">
									<i class="icon-directional"></i>
								</span>
							</div>
						</div>
					<?php } ?>
					<div id="desktop_menu" class="lg:block hidden xl:col-span-2 col-span-4 rbb-header-center">
						<?php if ( Helper::show_search_product_form_mobile() ) { ?>
						<div class="search_desktop animate-[500ms] lg:hidden"></div>
						<?php } ?>
						<div id="rbb-site-navigation" class="rbb-main-navigation screen">
							<nav id="menu-main" class="menu primary-menu">
								<?php echo Menu::primary_menu(); // phpcs:ignore ?>
							</nav>
						</div>
						<div class="lg:hidden mt-8 items-center mobile_bottom">
							<div class="flex mb-1.5 animate-[1500ms]">
								<span class="pr-1 font-bold"><?php echo esc_html__('Call Us:', 'automize'); ?> </span>
								<?php echo do_shortcode('[rbb_contact type="phone"]'); ?>
							</div>
							<div class="flex mb-[25px] animate-[1600ms]">
								<span class="pr-1 font-bold"><?php echo esc_html__('Email:', 'automize'); ?></span>
								<?php echo do_shortcode('[rbb_contact type="email"]'); ?>
							</div>
							<div class="animate-[1700ms] social_content"></div>
						</div>
					</div>
					<?php
					if ( Helper::show_search_product_form() || Helper::show_mini_cart() ) {
						?>
						<div id="rbb-header-right" class="rbb-header-right xl:col-span-1 lg:col-span-2 md:col-span-4 h-full flex min-w-[80px] justify-end">
							<?php if ( Helper::show_search_product_form() ) { ?>
								<div class="rbb-product-search relative flex items-center justify-center mr-5" <?php echo Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_OVERLAY) ? 'onclick="RbbThemeSearch.openSearchForm(event)"' : ''; ?>>
									<div class="rbb-product-search-icon-wrap cursor-pointer group w-[50px] h-[50px] bg-[#eeeeee]  justify-center items-center flex">
										<span class="rbb-product-search-icon group-hover:!text-[color:var(--rbb-general-secondary-color)] duration-300 <?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON)); ?>"></span>
									</div>
									<div class="rbb-product-search-content2 invisible absolute right-0 top-1/2 -translate-y-1/2">
										<?php if ( Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_OVERLAY) ) { ?>
											<?php Tag::search(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_OVERLAY)); // phpcs:ignore ?>
										<?php } else { ?> 
											<div id="rbb-search-content">
												<div id="_desktop_search" class="rbb-search-top relative">
													<?php Tag::search(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_OVERLAY)); // phpcs:ignore ?>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
							<?php
							if ( Helper::show_mini_cart() ) {
								RisingBambooWoo::instance()->mini_cart();
							}
							?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<div class="header-mobile shadow-[0_0px_15px_0_rgba(0,0,0,0.1)] bg-white px-[15px] md:hidden">
		<div class="flex items-center justify-between min-h-[60px]">
		<div class="menu-mobile flex items-center min-w-[60px]">
			<span class="toggle-megamenu relative mr-5 cursor-pointer">
				<i class="icon-directional"></i>
			</span>
			<?php if ( Helper::show_search_product_form() ) { ?>
			<div>
				<span class="search-mobile text-center text-black w-[22px] py-3 cursor-pointer text-[25px] block">
					<i class="rbb-icon-search-10 w-[18px] h-[18px]"></i>
				</span>
				<div id="_mobile_search" class="product-search-mobile absolute z-10 inset-x-0 top-full w-full opacity-0 invisible">
				</div>
			</div>
		<?php } ?>
		</div>
			<div id="_mobile_logo" class="px-5 flex items-center justify-center"></div>
			<div class="header-mobile-right min-w-[60px] flex items-center justify-end">
				<div id="_mobile_cart" class="rbb-mini-cart"></div>
			</div>
		</div>
	</div>
</header><!-- #masthead -->
