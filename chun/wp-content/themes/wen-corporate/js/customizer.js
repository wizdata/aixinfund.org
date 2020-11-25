/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Read more text
	wp.customize( 'read_more_text', function( value ) {
		value.bind( function( to ) {
			$( '.read-more' ).text( to );
		} );
	} );

	// Copyright Text
	wp.customize( 'copyright_text', function( value ) {
		value.bind( function( to ) {
			$( '.copyright' ).text( to );
		} );
	} );

} )( jQuery );
