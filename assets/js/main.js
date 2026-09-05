/**
 * BDC News Desk front-end interactions: mobile nav toggle and
 * touch-friendly dropdown reveal for the primary menu.
 */
( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {
		var navbar = document.querySelector( '.bdcnd-navbar' );
		var toggle = document.querySelector( '.bdcnd-nav-toggle' );

		if ( toggle && navbar ) {
			toggle.addEventListener( 'click', function () {
				var isOpen = navbar.classList.toggle( 'bdcnd-nav-open' );
				toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
			} );
		}

		var parents = document.querySelectorAll( '.bdcnd-navbar .menu-item-has-children > a' );
		parents.forEach( function ( link ) {
			link.addEventListener( 'click', function ( e ) {
				if ( window.matchMedia( '(max-width: 780px)' ).matches ) {
					e.preventDefault();
					link.parentElement.classList.toggle( 'bdcnd-submenu-open' );
				}
			} );
		} );

		var tabs = document.querySelectorAll( '.bdcnd-tab-row .bdcnd-tab' );
		tabs.forEach( function ( tab ) {
			tab.addEventListener( 'click', function () {
				var row = tab.closest( '.bdcnd-tab-row' );
				row.querySelectorAll( '.bdcnd-tab' ).forEach( function ( t ) {
					t.classList.remove( 'bdcnd-active' );
				} );
				tab.classList.add( 'bdcnd-active' );
				var target = row.parentElement.querySelectorAll( '[data-tab-panel]' );
				target.forEach( function ( panel ) {
					panel.hidden = panel.getAttribute( 'data-tab-panel' ) !== tab.getAttribute( 'data-tab' );
				} );
			} );
		} );
	} );
} )();
