<?php namespace WAJLinks;
	/*
	Plugin Name:  WAJ Links
	Plugin URI:   https://github.com/waughjai/copyright-year
	Description:  Simple plugin for easy generation o' link HTML for various types o' links.
	Version:      1.3.0
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
	use WaughJ\HTMLPhoneLink\HTMLPhoneLink;
	use WaughJ\WPMediaLink\WPMediaLink;

	add_shortcode
	(
		'link',
		function ( $atts, $content )
		{
			$atts = makeEmptyArrayIfNotArray( $atts );
			$href = TestHashItemString( $atts, 'href', $content );
			$content = ( $content ) ? do_shortcode( $content ) : TestHashItemString( $atts, 'value', $href );
			unset( $atts[ 'href' ], $atts[ 'value' ] );
			return ( !empty( $href ) ) ? ( string )( new HTMLLink( $href, $content, $atts ) ) : '';
		}
	);

	add_shortcode
	(
		'mail-link',
		function ( $atts, $content )
		{
			$atts = makeEmptyArrayIfNotArray( $atts );
			$email = TestHashItemString( $atts, 'email', TestHashItemString( $atts, 'mailto', $content ) );
			if ( $content )
			{
				$atts[ "value" ] = $content;
			}
			unset( $atts[ 'email' ] );
			return ( !empty( $email ) ) ? ( string )( new HTMLMailLink( $email, $atts ) ) : '';
		}
	);

	add_shortcode
	(
		'post-link',
		function ( $atts, $content )
		{
			$atts = makeEmptyArrayIfNotArray( $atts );
			if ( $content )
			{
				$atts[ "value" ] = do_shortcode( $content );
			}
			$link = new WPPostLink( $atts );
			return ( !empty( $link->getURL() ) ) ? $link->getHTML() : '';
		}
	);

	add_shortcode
	(
		'category-link',
		function ( $atts, $content )
		{
			$atts = makeEmptyArrayIfNotArray( $atts );
			if ( $content )
			{
				$atts[ "value" ] = do_shortcode( $content );
			}
			$link = new WPCategoryLink( $atts );
			return ( !empty( $link->getURL() ) ) ? $link->getHTML() : '';
		}
	);

	add_shortcode
	(
		'tag-link',
		function ( $atts, $content )
		{
			$atts = makeEmptyArrayIfNotArray( $atts );
			if ( $content )
			{
				$atts[ "value" ] = do_shortcode( $content );
			}
			$link = new WPTagLink( $atts );
			return ( !empty( $link->getURL() ) ) ? $link->getHTML() : '';
		}
	);

	add_shortcode
	(
		'home-link',
		function ( $atts, $content )
		{
			$atts = makeEmptyArrayIfNotArray( $atts );
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
		function ( $atts, $content )
		{
			$atts = makeEmptyArrayIfNotArray( $atts );
			$phone = TestHashItemString( $atts, 'phone', TestHashItemString( $atts, 'tel', $content ) );
			if ( $content )
			{
				$atts[ "value" ] = $content;
			}
			unset( $atts[ 'phone' ] );
			return ( !empty( $phone ) ) ? ( string )( new HTMLPhoneLink( $phone, $atts ) ) : '';
		}
	);

	add_shortcode
	(
		'media-link',
		function ( $atts, $content )
		{
			$atts = makeEmptyArrayIfNotArray( $atts );
			$id = TestHashItemExists( $atts, 'media_id', TestHashItemExists( $atts, 'media-id', '' ) );
			$content = ( $content ) ? do_shortcode( $content ) : TestHashItemString( $atts, 'value', null );
			unset( $atts[ 'id' ], $atts[ 'value' ] );
			return ( $id !== null && $content !== null ) ? ( string )( new WPMediaLink( $id, $content, $atts ) ) : '';
		}
	);

	function makeEmptyArrayIfNotArray( $array ) : array
	{
		return ( is_array( $array ) ) ? $array : [];
	}
