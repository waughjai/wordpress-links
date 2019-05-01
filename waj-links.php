<?php
	/*
	Plugin Name:  WAJ Links
	Plugin URI:   https://github.com/waughjai/copyright-year
	Description:  Simple plugin for easy generation o' link HTML for various types o' links.
	Version:      1.2.0
	Author:       Jaimeson Waugh
	Author URI:   https://www.jaimeson-waugh.com
	License:      GPL2
	License URI:  https://www.gnu.org/licenses/gpl-2.0.html
	Text Domain:  waj-links
	*/

	require_once( 'vendor/autoload.php' );

	use function WaughJ\TestHashItem\TestHashItemString;
	use function WaughJ\TestHashItem\TestHashItemExists;
	use WaughJ\HTMLLink\HTMLLink;
	use WaughJ\HTMLMailLink\HTMLMailLink;
	use WaughJ\WPPostLink\WPPostLink;
	use WaughJ\WPCategoryLink\WPCategoryLink;
	use WaughJ\WPTagLink\WPTagLink;
	use WaughJ\WPHomeLink\WPHomeLink;
	use WaughJ\WPPhoneLink\WPPhoneLink;
	use WaughJ\WPMediaLink\WPMediaLink;

	add_shortcode
	(
		'link',
		function ( array $atts, $content )
		{
			$href = TestHashItemString( $atts, 'href', '' );
			$content = ( $content ) ? do_shortcode( $content ) : TestHashItemString( $atts, 'value', $href );
			unset( $atts[ 'href' ], $atts[ 'value' ] );
			return ( string )( new HTMLLink( $href, $content, $atts ) );
		}
	);

	add_shortcode
	(
		'mail-link',
		function ( array $atts, $content )
		{
			$email = ( $content ) ? do_shortcode( $content ) : TestHashItemString( $atts, 'email', '' );
			if ( $content )
			{
				$atts[ "value" ] = $content;
			}
			unset( $atts[ 'email' ] );
			return ( string )( new HTMLMailLink( $email, $atts ) );
		}
	);

	add_shortcode
	(
		'post-link',
		function ( array $atts, $content )
		{
			if ( $content )
			{
				$atts[ "value" ] = do_shortcode( $content );
			}
			return ( string )( new WPPostLink( $atts ) );
		}
	);

	add_shortcode
	(
		'category-link',
		function ( array $atts, $content )
		{
			if ( $content )
			{
				$atts[ "value" ] = do_shortcode( $content );
			}
			return ( string )( new WPCategoryLink( $atts ) );
		}
	);

	add_shortcode
	(
		'tag-link',
		function ( array $atts, $content )
		{
			if ( $content )
			{
				$atts[ "value" ] = do_shortcode( $content );
			}
			return ( string )( new WPTagLink( $atts ) );
		}
	);

	add_shortcode
	(
		'home-link',
		function ( array $atts, $content )
		{
			if ( $content )
			{
				$atts[ "value" ] = do_shortcode( $content );
			}
			return ( string )( new WPHomeLink( $atts ) );
		}
	);

	add_shortcode
	(
		'phone-link',
		function ( array $atts, $content )
		{
			$phone = ( $content ) ? do_shortcode( $content ) : TestHashItemString( $atts, 'phone', '' );
			if ( $content )
			{
				$atts[ "value" ] = $content;
			}
			unset( $atts[ 'phone' ] );
			return ( string )( new HTMLPhoneLink( $phone, $atts ) );
		}
	);

	add_shortcode
	(
		'media-link',
		function ( array $atts, $content )
		{
			$id = TestHashItemExists( $atts, 'id', '' );
			$content = ( $content ) ? do_shortcode( $content ) : TestHashItemString( $atts, 'value', null );
			unset( $atts[ 'id' ], $atts[ 'value' ] );
			return ( $id !== null && $content !== null ) ? ( string )( new WPMediaLink( $id, $content, $atts ) ) : '';
		}
	);
