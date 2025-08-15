/**
 * Main JavaScript file.
 *
 * @version 1.0.0
 */

'use strict';

import RbbThemeNavigation from './component/navigation';
import RbbThemeSkipLinkFocus from './component/skip-link-focus-fix';
import './component/sticky-header';
import RbbThemeSearch from './component/search';
import RbbThemeOverlayScrollBar from './component/overlay-scroll-bar';
import RbbThemeSlickJs from './component/slick';
import RbbThemePromotionPopup from './component/promotion-popup';
import RbbThemeLightBox from './component/lightbox';
import Wow from 'wow.js';
import RbbMobileNavigation from './component/mobile-navigation';
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';
import 'tippy.js/animations/scale.css';

document.addEventListener( 'DOMContentLoaded', () => {
	const navigation = new RbbThemeNavigation();
	RbbThemeSkipLinkFocus();
	navigation.setupNavigation();
	navigation.enableTouchFocus();
} );
const RisingBamboo = {
	config: {},

	adminBarHeight: 0,

	scrollPosition: 0,

	init() {
		const $this = this;
		$this.setConfig();
		$this.setScrollPosition();
		$this.setAdminBarHeight();
		$this.initStickyElements();
		$this.initScrollToTop();
		$this.searchActive();
		$this.menuNavigation();
		$this.menuCanvas();
		$this.copy();
		$this.headerMobile();
		$this.verticalToggle();
		$this.gallery();
		$this.menuMobileBottom();
		$this.closeSearch();
		$this.elementorMenu();
		$this.footerMobile();
		$this.toggleElement( '.toggle-login', '.toggle-login ' );
		$this.SearchToggle();
		$this.ContactPhone();
		$this.ToolTip();
		$this.rbbinitComparisons();
		$this.runParallax(
			'.parallax_bg_banner .elementor-background-overlay'
		);
		$this.parallax();
		$this.toggleElement(
			'.click-search-mobile',
			'.rbb-product-search-content2 '
		);
		if ( jQuery( window ).width() < 768 ) {
			$this.toggleStyles( '_desktop_', '_mobile_' );
		}
		if ( jQuery( window ).width() < 1023 ) {
			$this.toggleStyles( 'desktop_', 'mobile_' );
			$this.toggleStyles( 'header-vertical_', 'mobile-vertical_' );
		}
		if ( jQuery( window ).width() < 1199 ) {
			$this.toggleStyles(
				'desktop-elementor-vertical_',
				'mobile-vertical_'
			);
		}

		RbbThemeSearch.ajaxSearch();
		let currentWidth = jQuery( window ).width();
		const minWidth = 768;
		const minWidth2 = 1023;
		const minWidth3 = 1199;
		jQuery( window ).on( 'resize', function () {
			const _cw = currentWidth;
			const _mw = minWidth;
			const _w = jQuery( window ).width();
			const _toggle =
				( _cw >= _mw && _w < _mw ) || ( _cw < _mw && _w >= _mw );
			currentWidth = _w;
			if ( _toggle ) {
				$this.toggleStyles( '_desktop_', '_mobile_' );
			}
			const _mw2 = minWidth2;
			const _toggle2 =
				( _cw >= _mw2 && _w < _mw2 ) || ( _cw < _mw2 && _w >= _mw2 );
			currentWidth = _w;
			if ( _toggle2 ) {
				$this.toggleStyles( 'desktop_', 'mobile_' );
				$this.toggleStyles( 'header-vertical_', 'mobile-vertical_' );
			}
			const _mw3 = minWidth3;
			const _toggle3 =
				( _cw >= _mw3 && _w < _mw3 ) || ( _cw < _mw3 && _w >= _mw3 );
			currentWidth = _w;
			if ( _toggle3 ) {
				$this.toggleStyles(
					'desktop-elementor-vertical_',
					'mobile-vertical_'
				);
			}
			$this.footerMobile();
			$this.onWindowResize();
		} );
		new RbbThemeSlickJs( '.rbb-slick-el' );
		new RbbThemeOverlayScrollBar();
		new RbbThemePromotionPopup();
		new RbbThemeLightBox( '#rbb-gallery-lightbox' );
		jQuery( window ).on( 'scroll', function () {
			$this.onWindowScroll();
		} );
		window.addEventListener( 'click', () => {
			$this.loginSwitch();
		} );
		new Wow().init();
	},
	setConfig() {
		if ( typeof window.rbb_config === 'object' ) {
			this.config = window.rbb_config;
		}
	},

	setScrollPosition() {
		this.scrollPosition = jQuery( 'window' ).scrollTop();
	},

	setAdminBarHeight() {
		const adminBar = document.querySelector( '#wpadminbar' );

		if ( adminBar && window.outerWidth > 600 ) {
			this.adminBarHeight = adminBar.offsetHeight;
		}
	},

	initStickyElements() {
		jQuery( '.rbb-header-sticky' ).RbbStickyHeader(
			this.config.header_sticky
		);
		new RbbMobileNavigation(
			'#rbb-mobile-navigation',
			this.config.mobile_navigation
		);
	},

	initScrollToTop() {
		const $button = jQuery( '.scroll-to-top' );
		jQuery( window ).scroll( function () {
			const offset = 50;
			if ( window.scrollY > offset ) {
				$button.removeClass( 'scale-0 opacity-0 pointer-events-none' );
			} else {
				$button.addClass( 'scale-0 opacity-0 pointer-events-none' );
			}
		} );
		$button.on( 'click', function ( e ) {
			jQuery( 'body, html' ).animate(
				{
					scrollTop: 0,
				},
				400
			);

			e.preventDefault();
		} );
		const progressPath = document.querySelector( '.scroll-to-top path' );
		if ( ! progressPath ) {
			return;
		}
		const pathLength = progressPath.getTotalLength();
		progressPath.style.transition = progressPath.style.WebkitTransition =
			'none';
		progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
		progressPath.style.strokeDashoffset = pathLength;
		progressPath.getBoundingClientRect();
		progressPath.style.transition = progressPath.style.WebkitTransition =
			'stroke-dashoffset 10ms linear';
		const updateProgress = function () {
			const scroll = jQuery( window ).scrollTop();
			const height =
				jQuery( document ).height() - jQuery( window ).height();
			const progress = pathLength - ( scroll * pathLength ) / height;
			progressPath.style.strokeDashoffset = progress;
		};
		updateProgress();
		jQuery( window ).scroll( updateProgress );
	},

	onWindowResize() {
		this.setAdminBarHeight();
	},

	onWindowScroll() {
		const isScrollUp = jQuery( window ).scrollTop() < this.scrollPosition;

		if ( isScrollUp ) {
			jQuery( window ).triggerHandler( 'scroll:up' );
		} else {
			jQuery( window ).triggerHandler( 'scroll:down' );
		}

		this.scrollPosition = jQuery( window ).scrollTop();
	},

	toggleElement( $clickAble, content ) {
		jQuery( $clickAble ).on( 'click', function () {
			if ( jQuery( content ).hasClass( 'active' ) ) {
				jQuery( content ).removeClass( 'active' );
			} else {
				jQuery( content ).addClass( 'active' );
			}
		} );
		jQuery( content )
			.find( '.close' )
			.on( 'click', function () {
				if ( jQuery( content ).hasClass( 'active' ) ) {
					jQuery( content ).removeClass( 'active' );
				}
			} );
		jQuery( document ).mouseup( function ( e ) {
			if ( jQuery( e.target ).closest( content ).length === 0 ) {
				jQuery( content ).removeClass( 'active' );
			}
		} );
	},
	menuMobile( menuLevel ) {
		const $document = jQuery( document );
		$document.on( 'click', menuLevel, function () {
			const $this = jQuery( this );
			const $parent = $this.parent();
			const $closestUl = $this.closest( 'ul' );
			if ( $parent.hasClass( 'menu-active' ) ) {
				$parent
					.removeClass( 'menu-active' )
					.css( { 'z-index': '1', position: 'relative' } );
				$closestUl
					.removeClass( 'active' )
					.css( { top: '50px', transform: 'translateX(0%)' } );
			} else {
				$parent
					.addClass( 'menu-active' )
					.css( { 'z-index': '9', position: 'static' } );
				const translateValue = jQuery( 'body' ).hasClass( 'rtl' )
					? '100%'
					: '-100%';
				$closestUl.addClass( 'active' ).css( {
					top: '0px',
					transform: `translateX(${ translateValue })`,
				} );
			}
			jQuery( '.mega-menu .rbb-slick-carousel' ).slick( 'refresh' );
		} );
	},
	menuNavigation() {
		const desktopSocial = document.getElementById( 'desktop-social' );
		const desktopSearch = document.getElementById( '_desktop_search' );
		const mobileTop = document.querySelector( '.search_desktop' );
		const mobileBottom = document.querySelector(
			'.mobile_bottom .social_content'
		);
		if ( desktopSocial && mobileBottom ) {
			mobileBottom.innerHTML = desktopSocial.innerHTML;
		}
		if ( desktopSearch && mobileTop ) {
			mobileTop.innerHTML = desktopSearch.innerHTML;
		}
		const checkAndAddBlocks = () => {
			if ( jQuery( '.rbb-main-navigation' ).hasClass( 'screen' ) ) {
				if ( jQuery( window ).width() < 1023 ) {
					this.menuMobile( '#mobile_menu .opener' );
					this.menuMobile( '#mobile_menu .opener2' );
					jQuery( document ).on(
						'click',
						'.toggle-megamenu, .canvas-overlay',
						function () {
							if (
								jQuery( '.search_desktop' ).hasClass(
									'fadeInLeft'
								)
							) {
								jQuery( '.search_desktop' ).removeClass(
									'fadeInLeft'
								);
								jQuery( '.mobile_bottom > div' ).removeClass(
									'fadeInLeft'
								);
								jQuery(
									'#mobile_menu .menu-container > li'
								).removeClass( 'fadeInLeft' );
							} else {
								jQuery( '.search_desktop' ).addClass(
									'fadeInLeft'
								);
								jQuery( '.mobile_bottom > div' ).addClass(
									'fadeInLeft'
								);
								jQuery(
									'#mobile_menu .menu-container > li'
								).addClass( 'fadeInLeft' );
							}
						}
					);
					const ul = document.getElementById( 'menu-main' );
					const liElements = ul.querySelectorAll(
						'.menu-container > li'
					);
					let $y = 800;
					for ( let i = 0; i < liElements.length; i++ ) {
						const li = liElements[ i ];
						jQuery( li ).css( 'animation-duration', $y + 'ms' );
						$y = $y + 150;
					}
				}
			}
		};
		checkAndAddBlocks();
		window.addEventListener( 'resize', checkAndAddBlocks );
	},
	menuCanvas() {
		this.menuMobile( '.rbb-menu-canvas .opener' );
		this.menuMobile( '.rbb-menu-canvas .opener2' );
		jQuery( document ).on( 'click', '.menu_close', function () {
			const $menuCanvas = jQuery( '.rbb-menu-canvas' );
			const $menuClose = jQuery( '.menu_close' );
			const $body = jQuery( 'body' );
			if ( $menuCanvas.hasClass( 'show' ) ) {
				$menuCanvas.removeClass( 'show' );
				$menuClose.removeClass( 'active' );
				$body.removeClass( 'active' );
				if ( jQuery( window ).width() < 767 ) {
					$body.css( 'overflow', 'initial' );
				}
			} else {
				RisingBambooModal.modal( '.rbb-menu-canvas' );
				$menuCanvas.addClass( 'show' );
				$menuClose.addClass( 'active' );
				$body.addClass( 'active' );
				if ( jQuery( window ).width() < 767 ) {
					$body.css( 'overflow', 'hidden' );
				}
			}
		} );
		jQuery( document ).on( 'click', '.rbb-modal-backdrop', function () {
			const $body = jQuery( 'body' );
			jQuery( '.menu_close' ).removeClass( 'active' );
			if ( jQuery( window ).width() < 767 ) {
				$body.css( 'overflow', 'initial' );
			}
		} );
		if ( jQuery( '.rbb-menu-canvas' ).hasClass( 'rbb-modal' ) ) {
			const ul = document.getElementById( 'menu-main' );
			const liElements = ul.querySelectorAll( '.menu-container > li' );
			let $y = 800;
			for ( let i = 0; i < liElements.length; i++ ) {
				const li = liElements[ i ];
				jQuery( li )
					.addClass( 'fadeInLeft' )
					.css( 'animation-duration', $y + 'ms' );
				$y = $y + 150;
			}
		}
	},
	clickCanvasMenu( selector, content, overlaySelector, ...closeElements ) {
		jQuery( document ).on( 'click', selector, function () {
			const isActive = jQuery( this )
				.toggleClass( 'active' )
				.hasClass( 'active' );
			jQuery( 'body' ).css( 'overflow', isActive ? 'hidden' : 'auto' );
			jQuery( [ overlaySelector, content ].join( ', ' ) ).toggleClass(
				'active',
				isActive
			);
			jQuery( closeElements.join( ', ' ) ).removeClass( 'active' );
		} );
	},
	handleOverlayClick( overlaySelector, content, closeElements ) {
		jQuery( document ).on( 'click', overlaySelector, function () {
			if ( jQuery( this ).hasClass( 'active' ) ) {
				jQuery( this ).removeClass( 'active' );
				jQuery( 'body' ).css( 'overflow', 'auto' );
				jQuery(
					[ overlaySelector, content, closeElements ].join( ', ' )
				).removeClass( 'active' );
			} else {
				jQuery( this ).addClass( 'active' );
				jQuery( 'body' ).css( 'overflow', 'hidden' );
				jQuery(
					[ overlaySelector, content, closeElements ].join( ', ' )
				).addClass( 'active' );
			}
		} );
	},
	headerMobile() {
		this.clickCanvasMenu(
			'.toggle-megamenu',
			'#mobile_menu',
			'.canvas-overlay',
			'.search-mobile',
			'#_mobile_search',
			'.rbb_results'
		);
		this.clickCanvasMenu(
			'.icon-vertical-menu',
			'#mobile-vertical_menu',
			'.canvas-overlay2',
			'.search-mobile',
			'#_mobile_search',
			'.rbb_results',
			'.toggle-megamenu',
			'#mobile_menu',
			'.canvas-overlay'
		);
		this.handleOverlayClick(
			'.canvas-overlay',
			'#mobile_menu',
			'.toggle-megamenu'
		);
		this.handleOverlayClick(
			'.canvas-overlay2',
			'#mobile-vertical_menu',
			'.icon-vertical-menu'
		);
		jQuery( document ).on( 'click', '.search-mobile', function () {
			if ( jQuery( '.search-mobile' ).hasClass( 'active' ) ) {
				jQuery(
					'.search-mobile, .product-search-mobile, .rbb_results, .canvas-overlay, #mobile_menu'
				).removeClass( 'active' );
				jQuery( 'body' ).css( 'overflow', 'auto' );
			} else {
				jQuery(
					'.search-mobile, .product-search-mobile, .rbb_results'
				).addClass( 'active' );
				jQuery( 'body' ).css( 'overflow', 'hidden' );
			}
			jQuery(
				'.canvas-overlay, .toggle-megamenu, #mobile_menu'
			).removeClass( 'active' );
		} );
	},
	searchActive() {
		const resultsTop = jQuery( '.rbb-header-sticky' ).height();
		jQuery( '.rbb_results' ).css( 'top', resultsTop + 'px' );
		if ( jQuery( window ).width() < 768 ) {
			jQuery( document ).on( 'keyup', '.input-search', function () {
				const term = jQuery( this ).val();
				if ( term.length > 0 ) {
					jQuery( '.btn-search_clear-text' ).show();
				} else {
					jQuery( '.btn-search_clear-text' ).hide();
				}
				jQuery( document ).on(
					'click',
					'.btn-search_clear-text',
					function () {
						jQuery( '.input-search' ).val( '' );
						jQuery( '.btn-search_clear-text' ).hide();
						jQuery( '.rbb_results' ).removeClass( 'active' );
						jQuery( 'body' ).removeClass( 'active' );
					}
				);
			} );
		}
	},
	footerElement( $footerTitle, $footerContent ) {
		if ( jQuery( window ).width() < 768 ) {
			jQuery( document )
				.off( 'click', $footerTitle )
				.on( 'click', $footerTitle, function () {
					const $this = jQuery( this );
					$this
						.find( $footerContent )
						.slideToggle( 'show', function () {} );
					$this
						.find( '.elementor-heading-title' )
						.toggleClass( 'active' );
				} );
		} else {
			jQuery( document ).off( 'click', $footerTitle );
			jQuery( $footerTitle ).each( function () {
				const $this = jQuery( this );
				$this.find( $footerContent ).show();
				$this
					.find( '.elementor-heading-title' )
					.removeClass( 'active' );
			} );
		}
	},
	footerMobile() {
		this.footerElement( '.footer-title', '.elementor-icon-list-items' );
		this.footerElement( '.category-title', '.elementor-inner-section' );
	},
	loginSwitch() {
		jQuery( document ).on( 'click', '.login_switch', function () {
			if ( jQuery( this ).hasClass( 'login-btn' ) ) {
				jQuery( '.login_switch_title' ).css(
					'transform',
					'translate(0)'
				);
				jQuery( '#rbb_login' ).slideDown();
				jQuery( '#rbb_register' ).slideUp();
			} else {
				jQuery( '.login_switch_title' ).css(
					'transform',
					'translate(100%)'
				);
				jQuery( '#rbb_login' ).slideUp();
				jQuery( '#rbb_register' ).slideDown();
			}
		} );
	},
	copy() {
		jQuery( document ).on( 'click', '.copy-btn', function () {
			const el = jQuery( this );
			const copyText = el.siblings( 'input' )[ 0 ];
			copyText.select();
			const selection = copyText.ownerDocument.defaultView.getSelection();
			document.execCommand( 'copy' );
			selection.removeAllRanges();
			const copy = el.data( 'copy' );
			const copied = el.data( 'copied' );
			el.text( copied );
			setTimeout( () => el.text( copy ), 2500 );
		} );
	},
	verticalToggle() {
		if ( jQuery( window ).width() > 1023 ) {
			jQuery( '.vertical-menu2 .vertical-menu-title' ).removeClass(
				'icon-vertical-menu'
			);
			jQuery( document ).on(
				'click',
				'.vertical-menu .vertical-menu-title',
				function ( e ) {
					if ( jQuery( this ).hasClass( 'active' ) ) {
						jQuery( this ).removeClass( 'active' );
					} else {
						jQuery( this ).addClass( 'active' );
					}
					jQuery( '.vertical-menu-content' ).slideToggle();
					e.stopPropagation();
				}
			);
		} else {
			jQuery( '.vertical-menu .vertical-menu-title' ).addClass(
				'icon-vertical-menu'
			);
		}
		jQuery( document ).on(
			'click',
			'#mobile-vertical_menu .opener',
			function () {
				if ( jQuery( this ).parent().hasClass( 'menu-active' ) ) {
					jQuery( this ).parent().removeClass( 'menu-active' );
					jQuery( this )
						.parent()
						.children( '.sub-menu' )
						.slideUp( 300 );
				} else {
					jQuery( this )
						.parent()
						.parent()
						.find( 'li' )
						.removeClass( 'menu-active' );
					jQuery( this )
						.parent()
						.parent()
						.find( 'li' )
						.children( '.sub-menu' )
						.slideUp( 300 );
					jQuery( this ).parent().addClass( 'menu-active' );
					jQuery( this )
						.parent()
						.children( '.sub-menu' )
						.slideDown( 300 );
				}
			}
		);
	},
	toggleStyles( prefix1, prefix2 ) {
		function swapChildren( obj1, obj2 ) {
			const temp = obj2.children().detach();
			obj2.empty().append( obj1.children().detach() );
			obj1.append( temp );
		}
		jQuery( `*[id^='${ prefix1 }']` ).each( function ( idx, el ) {
			const targetId = el.id.replace( prefix1, prefix2 );
			const target = jQuery( `#${ targetId }` );
			if ( target.length ) {
				swapChildren( jQuery( el ), target );
			}
		} );
	},
	gallery() {
		jQuery( window ).scroll( function () {
			jQuery( '.gallery' ).each( function () {
				const currentPosition = jQuery( window ).scrollTop(),
					offsetTop = jQuery( this ).offset().top;
				if ( currentPosition - offsetTop < 0 ) {
					const scrolled = ( offsetTop - currentPosition ) * 0.1;
					jQuery( '.itemy_parallax .gallery' ).css(
						'transform',
						'translateX(-' + scrolled + 'px)'
					);
					jQuery( '.reversex_parallax .gallery' ).css(
						'transform',
						'translateX(' + scrolled + 'px)'
					);
				} else {
					const scrolled = ( currentPosition - offsetTop ) * 0.1;
					jQuery( '.itemy_parallax .gallery' ).css(
						'transform',
						'translateX(' + scrolled + 'px)'
					);
					jQuery( '.reversex_parallax .gallery' ).css(
						'transform',
						'translateX(-' + scrolled + 'px)'
					);
				}
			} );
		} );
	},
	runParallax( selector ) {
		const el = jQuery( selector );
		el.each( function ( index, element ) {
			const intersectionObserver = new IntersectionObserver(
				( entries ) => {
					entries.forEach( ( entry ) => {
						if ( entry.isIntersecting ) {
							jQuery( element ).addClass( 'act' );
						} else {
							jQuery( element ).removeClass( 'act' );
						}
					} );
				}
			);
			const elementDOM = jQuery( element ).get( 0 );
			intersectionObserver.observe( elementDOM );
		} );
	},
	parallax() {
		jQuery( window ).scroll( function () {
			jQuery(
				'.parallax_bg_banner .elementor-background-overlay.act'
			).each( function () {
				const currentPosition = jQuery( window ).scrollTop(),
					offsetTop = jQuery( this ).offset().top;
				let scrolled = ( currentPosition - offsetTop ) * 0.1;
				scrolled = Math.min( 150, Math.abs( scrolled ) );

				if ( currentPosition - offsetTop < 0 ) {
					jQuery( this ).css(
						'transform',
						'translateY(' + scrolled + 'px)'
					);
				} else {
					jQuery( this ).css(
						'transform',
						'translateY(-' + scrolled + 'px)'
					);
				}
			} );
		} );
	},
	menuMobileBottom() {
		let thisurl = window.location;
		let urlmenu = '';
		thisurl = String( thisurl );
		thisurl = thisurl
			.replace( 'https://', '' )
			.replace( 'http://', '' )
			.replace( 'www.', '' )
			.replace( /#\w*/, '' );
		let thislink = '{/literal}{$current_link}{literal}';
		thislink = thislink
			.replace( 'https://', '' )
			.replace( 'http://', '' )
			.replace( 'www.', '' )
			.replace( /#\w*/, '' );
		jQuery( '#rbb-mobile-navigation a' ).each( function () {
			urlmenu = jQuery( this )
				.attr( 'href' )
				.replace( 'https://', '' )
				.replace( 'http://', '' )
				.replace( 'www.', '' )
				.replace( /#\w*/, '' );
			if (
				thisurl === urlmenu ||
				thisurl.replace( thislink, '' ) === urlmenu
			) {
				jQuery( this )
					.find( 'i' )
					.addClass( 'text-[var(--rbb-menu-link-hover-color)]' );
				return false;
			}
		} );
	},
	closeSearch() {
		jQuery( document ).on( 'click', '.close-search', function () {
			jQuery( 'body' ).css( 'overflow', 'auto' ).removeClass( 'active' );
			if ( jQuery( '.rbb_results' ).hasClass( 'active' ) ) {
				jQuery( '.rbb_results' ).removeClass( 'active' );
			} else {
				jQuery( '.rbb_results' ).addClass( 'active' );
			}
		} );
	},
	elementorMenu() {
		if (
			jQuery( 'div' ).hasClass( 'rbb-elementor-vertical-menu' ) ||
			jQuery( '#header-vertical_menu' ).length > 0
		) {
			if (
				jQuery( window ).width() < 1200 &&
				jQuery( 'div' ).hasClass( 'rbb-elementor-vertical-menu' )
			) {
				jQuery( '.rbb-elementor-vertical-menu' ).css(
					'display',
					'none'
				);
				jQuery(
					'<div class="icon-vertical-menu text-black text-2xl mr-5 rbb-icon-menu-5"></div>'
				).prependTo( '.rbb-elementor-menu' );
			}
			jQuery(
				'<div class="icon-vertical-menu text-black text-lg ml-5 rbb-icon-view-grid-1"></div>'
			).appendTo( '.header-mobile-right' );
		}
	},
	SearchToggle() {
		jQuery( document ).on(
			'click',
			'.rbb-product-search-icon-wrap',
			function () {
				if (
					jQuery( '.rbb-product-search-content2' ).hasClass(
						'active'
					)
				) {
					jQuery( '.rbb-product-search-content2' ).removeClass(
						'active'
					);
					jQuery( 'body' ).removeClass( 'open-search' );
				} else {
					jQuery( '.rbb-product-search-content2' ).addClass(
						'active'
					);
					jQuery( 'body' ).addClass( 'open-search' );
				}
			}
		);
		jQuery( document ).on( 'click', 'body.open-search', function () {
			if ( jQuery( '#desktop_search' ).hasClass( 'in' ) ) {
				jQuery( '.rbb-product-search-content2' ).removeClass(
					'active'
				);
				jQuery( 'body' ).removeClass( 'open-search' );
			}
		} );
	},
	ContactPhone() {
		const contactPhoneLink = document.querySelector( 'a.contact-phone' );
		if ( contactPhoneLink ) {
			const phoneNumberElement =
				contactPhoneLink.querySelector( 'p.pl-1.mb-0' );
			if ( phoneNumberElement ) {
				const phoneNumber = phoneNumberElement.textContent.trim();
				contactPhoneLink.href = 'tel:' + phoneNumber;
			} else {
				jQuery( '.group-contact-phone' ).css( 'display', 'none' );
			}
		}
	},
	rbbinitComparisons() {
		initBeforeAfter();
		function initBeforeAfter() {
			if ( jQuery( '.content-img-compare' ).length ) {
				jQuery( '.rbb-before-after .rbb-ba-wrap' ).each( function () {
					const wrap = jQuery( this );
					if ( ! jQuery( wrap ).hasClass( 'init' ) ) {
						initBeforeAfterEl( wrap );
						jQuery( wrap ).addClass( 'init' );
					}
				} );
			}
		}
		function initBeforeAfterEl( el ) {
			const supportsTouch =
				'ontouchstart' in window || navigator.msMaxTouchPoints;
			const $container = jQuery( el );
			const parentId = $container
				.closest( '.content-img-compare' )
				.attr( 'id' );
			const $parentElement = jQuery( `#${ parentId }` );
			const $before = $parentElement.find( '.before' );
			const $handle = $parentElement.find( '.handle' );
			const $beforeHeader = $parentElement.find(
				'.rbb-text-ba .rbb-before-header'
			);
			const $afterHeader = $parentElement.find(
				'.rbb-text-ba .rbb-after-header'
			);
			const maxX = $container.outerWidth();
			const offsetX = $container.offset().left;
			const mousemove = function ( e ) {
				e.preventDefault();
				const curX = e.clientX - offsetX;
				let curPos = ( curX / maxX ) * 100;
				if ( curPos > 100 ) {
					curPos = 100;
				}
				if ( curPos < 0 ) {
					curPos = 0;
				}
				$before.css( { right: 100 - curPos + '%' } );
				$handle.css( { left: curPos + '%' } );
				if ( curPos > 50 ) {
					$beforeHeader.css( {
						opacity: 0.1 + ( 2 * ( curPos - 50 ) ) / 100,
					} );
					$afterHeader.css( { opacity: 0.1 } );
				} else {
					$beforeHeader.css( { opacity: 0.1 } );
					$afterHeader.css( {
						opacity: 0.1 + ( 2 * ( 50 - curPos ) ) / 100,
					} );
				}
			};
			const mouseup = function ( e ) {
				e.preventDefault();
				if ( supportsTouch ) {
					jQuery( document ).off( 'touchmove', touchmove );
					jQuery( document ).off( 'touchend', touchend );
				} else {
					jQuery( document ).off( 'mousemove', mousemove );
					jQuery( document ).off( 'mouseup', mouseup );
				}
			};
			const mousedown = function ( e ) {
				e.preventDefault();
				if ( supportsTouch ) {
					jQuery( document ).on( 'touchmove', touchmove );
					jQuery( document ).on( 'touchend', touchend );
				} else {
					jQuery( document ).on( 'mousemove', mousemove );
					jQuery( document ).on( 'mouseup', mouseup );
				}
			};
			const touchstart = function ( e ) {
				mousedown( {
					preventDefault: e.preventDefault,
					clientX: e.originalEvent.changedTouches[ 0 ].pageX,
				} );
			};
			const touchmove = function ( e ) {
				mousemove( {
					preventDefault: e.preventDefault,
					clientX: e.originalEvent.changedTouches[ 0 ].pageX,
				} );
			};
			const touchend = function ( e ) {
				mouseup( {
					preventDefault: e.preventDefault,
					clientX: e.originalEvent.changedTouches[ 0 ].pageX,
				} );
			};
			if ( supportsTouch ) {
				$handle.on( 'touchstart', touchstart );
			} else {
				$handle.on( 'mousedown', mousedown );
			}
		}
	},
	ToolTip() {
		const tooltipElements = document.querySelectorAll( '[data-tooltips]' );
		tooltipElements.forEach( ( element ) => {
			tippy( element, {
				content: element.getAttribute( 'data-tooltips' ),
				arrow: true,
				animation: 'scale',
			} );
		} );
		document.addEventListener( 'DOMContentLoaded', function () {
			initTooltips();
		} );
		function initTooltips() {
			const tooltipElementss =
				document.querySelectorAll( '[data-tooltips]' );
			tooltipElementss.forEach( ( element ) => {
				tippy( element, {
					content: element.getAttribute( 'data-tooltips' ),
					arrow: true,
					animation: 'scale',
				} );
			} );
		}
		jQuery( document ).ajaxComplete( function () {
			initTooltips();
		} );
	},
};
window.RisingBamboo = RisingBamboo;
window.RbbThemeSearch = RbbThemeSearch;
jQuery( function () {
	RisingBamboo.init();
} );
