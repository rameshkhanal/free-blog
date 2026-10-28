/**
* Keyboard support for the menus.
*/
( function () {
	'use strict';

	function setUpMenu( menu ) {
		var links = menu.querySelectorAll( 'a' );
		var i;

		function toggleFocus() {
			var self = this;

			// Walk up to the top of this menu, marking each level open.
			while ( self && ! /\bnavbar-nav\b/.test( self.className ) ) {
				if ( 'LI' === self.tagName ) {
					self.classList.toggle( 'focus' );
				}
				self = self.parentNode;
			}
		}

		for ( i = 0; i < links.length; i++ ) {
			links[ i ].addEventListener( 'focus', toggleFocus, true );
			links[ i ].addEventListener( 'blur', toggleFocus, true );
		}
	}

	function setUpToggle( button ) {
		var target = document.querySelector( button.getAttribute( 'data-target' ) );

		if ( ! target ) {
			return;
		}

		if ( ! target.id ) {
			target.id = 'free-blog-menu-' + Math.floor( Math.random() * 100000 );
		}

		button.setAttribute( 'aria-controls', target.id );
		button.setAttribute( 'aria-expanded', /\bin\b/.test( target.className ) ? 'true' : 'false' );

		// Read the state back from the element after Bootstrap toggles it.
		[ 'shown.bs.collapse', 'hidden.bs.collapse' ].forEach( function ( name ) {
			target.addEventListener( name, function () {
				button.setAttribute( 'aria-expanded', /\bin\b/.test( target.className ) ? 'true' : 'false' );
			} );
		} );

		// No jQuery event bridge, so read the class shortly after the click.
		button.addEventListener( 'click', function () {
			window.setTimeout( function () {
				button.setAttribute( 'aria-expanded', /\bin\b/.test( target.className ) ? 'true' : 'false' );
			}, 400 );
		} );
	}

	function init() {
		var menus = document.querySelectorAll( '.navbar-nav' );
		var toggles = document.querySelectorAll( '.navbar-toggle[data-target]' );
		var i;

		for ( i = 0; i < menus.length; i++ ) {
			setUpMenu( menus[ i ] );
		}

		for ( i = 0; i < toggles.length; i++ ) {
			setUpToggle( toggles[ i ] );
		}
	}

	if ( 'loading' === document.readyState ) {
		document.addEventListener( 'DOMContentLoaded', init );
	} else {
		init();
	}
}() );
