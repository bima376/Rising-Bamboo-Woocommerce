<?php
/**
 * The default header.
 *
 * @package Rising_Bamboo
 */

use RisingBambooCore\Woocommerce\FreeShippingCalculator;
use RisingBambooTheme\App\App;
use RisingBambooTheme\App\Menu\Menu;
use RisingBambooTheme\Helper\Helper;
use RisingBambooTheme\Helper\Setting;
use RisingBambooTheme\Helper\Tag;
use RisingBambooTheme\Woocommerce\Woocommerce as RisingBambooWoo;
$modal_effect    = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_EFFECT);
$outside         = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_CLICK_OUTSIDE_CLOSE);
$backdrop_filter = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER);
$classes         = [ 'account-form-popup rbb-modal invisible fixed inset-0 z-50 ' ];
$classes[]       = ( true === $backdrop_filter ) ? 'backdrop' : 'backdrop-none';
$classes[]       = ( false === $outside ) ? 'outside-modal' : '';
$class_string    = implode(' ', array_filter($classes));
?>
<header id="rbb-default-header" class="rbb-default-header header-2 relative z-20 w-full bg-[color:var(--rbb-header-background-color)]">
	<div class="rbb-header-sticky relative">
		<div class="header-inner mx-auto h-full">
			<div class="relative h-full md:block hidden">
				<div class="2xl:container px-[15px] mx-auto h-full">
			<div class="header-top flex flex-nowrap items-center justify-between md:h-[99px] h-[60px]">
				<?php
				if ( Helper::show_logo() ) {
					?>
					<div id="rbb-branding" class="rbb-branding flex items-center rbb-header-left">
						<div class="lg:hidden items-center flex">
							<span class="toggle-megamenu relative mr-5 cursor-pointer">
								<i class="icon-directional"></i>
							</span>
						</div>
						<div id="_desktop_logo" class="inline-flex">
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
					</div>
				<?php } ?>
				<div id="desktop_menu" class="lg:block hidden rbb-header-top-center z-20">
					<?php if ( Helper::show_search_product_form_mobile() ) { ?>
					<div class="search_desktop animate-[500ms] lg:hidden"></div>
					<?php } ?>
					<div id="rbb-site-navigation" class="rbb-main-navigation screen">
						<nav id="menu-main" class="menu primary-menu h-full">
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
				if ( Helper::show_login_form() || Helper::show_search_product_form() || Helper::show_mini_cart() || Helper::show_wishlist() ) {
					?>
					<div class="header-right-group flex justify-end">
						<?php if ( Helper::show_login_form() ) { ?>
							<div class="rbb-account relative flex items-center justify-center mr-[25px] <?php echo esc_attr(( false === is_user_logged_in() && true === Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_POPUP) ) ? 'popup-account' : 'toggle-login'); ?> "
								<?php
								if ( false === is_user_logged_in() && true === Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_POPUP) ) {
									?>
									onclick="RisingBambooModal.modal('.account-form-popup', event)" <?php } ?>
									>
								<div class="rbb-account-icon-wrap relative duration-300 cursor-pointer h-10 w-10 flex items-center justify-center">
									<span class="rbb-account-icon cursor-pointer duration-300 <?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_ICON)); ?>"></span>
								</div>
								<div class="pl-1.5 leading-[15px] text-black">
									<span class="block text-xs leading-4 font-bold"><?php echo esc_html__('Account', 'automize'); ?></span>
									<span class="whitespace-nowrap text-[0.625rem]">
										<?php
										if ( is_user_logged_in() ) {
											echo esc_html__('Hi', 'automize') . ', ' . esc_html(ucwords(wp_get_current_user()->get('display_name')));
										} else {
											echo esc_html__('Hello, Login', 'automize');
										}
										?>
										</span>
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
						<?php if ( Helper::show_search_product_form() && Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_OVERLAY) ) { ?>
							<div id="_desktop_search" class="rbb-header-center flex items-center mr-[25px]">
								<div class="rbb-product-search relative cursor-pointer" onclick="RbbThemeSearch.openSearchForm(event)">
									<div class="rbb-product-search-icon-wrap">
										<span class="rbb-product-search-icon <?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON)); ?>"></span>
									</div>
									<div class="rbb-product-search-content">
				                        <?php Tag::search(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_OVERLAY)); // phpcs:ignore ?>
									</div>
								</div>
							</div>
						<?php } ?>
						<?php if ( Helper::show_wishlist() ) { ?>
							<div class="rbb-wishlist flex items-center justify-center mr-[25px]">
								<div class="relative">
									<a class="wishlist-icon-link group duration-300 h-10 w-10 flex items-center justify-center text-center" href="<?php echo esc_url(WPcleverWoosw::get_url()); ?>">
										<span class="wishlist-icon duration-300 <?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON)); ?>"></span>
									</a>
		                            <span class="wishlist-count text-black font-bold text-center rounded-full"><?php echo WPcleverWoosw::get_count(); // phpcs:ignore ?></span>
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
		<div class="2xl:container px-[15px] mx-auto h-full md:flex hidden">
			<?php if ( Helper::show_search_product_form() && false === Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_OVERLAY) ) { ?>
				<div class="rbb-elementor-menu relative z-10 h-[27px]"></div>
				<div id="_desktop_search" class="rbb-header-center relative w-full z-10 h-[27px]">
					<div class="rbb-product-search relative cursor-pointer" >
						<div class="rbb-product-search-content">
	                        <?php Tag::search(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_OVERLAY)); // phpcs:ignore ?>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="header-mobile shadow-[0_0px_15px_0_rgba(0,0,0,0.1)] px-[15px] md:hidden">
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
					<div id="_mobile_cart" class="rbb-mini-cart min-w-[60px] justify-end flex"></div>
				</div>
			</div>
		</div>
	</div>
	</div>
</header><!-- #masthead -->
