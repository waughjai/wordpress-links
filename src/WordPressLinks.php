<?php

declare( strict_types = 1 );
namespace WaughJ\WordPressLinks;

use WaughJ\HTMLLink\HTMLLink;
use WaughJ\HTMLMailLink\HTMLMailLink;
use WaughJ\HTMLPhoneLink\HTMLPhoneLink;
use WaughJ\TestHashItem\TestHashItem;
use WaughJ\WPCategoryLink\WPCategoryLink;
use WaughJ\WPHomeLink\WPHomeLink;
use WaughJ\WPMediaLink\WPMediaLink;
use WaughJ\WPPostLink\WPPostLink;
use WaughJ\WPTagLink\WPTagLink;

add_shortcode
(
	'link',
	function ( $atts, $content )
	{
		$atts = makeEmptyArrayIfNotArray( $atts );
		$href = TestHashItem::getString( $atts, 'href', $content );
		$content = ( $content ) ? do_shortcode( $content ) : TestHashItem::getString( $atts, 'value', $href );
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
		$email = TestHashItem::getString( $atts, 'email', TestHashItem::getString( $atts, 'mailto', $content ) );
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
		$phone = TestHashItem::getString( $atts, 'phone', TestHashItem::getString( $atts, 'tel', $content ) );
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
		$id = $atts[ 'media_id' ] ?? $atts[ 'media-id' ] ?? '';
		$content = ( $content ) ? do_shortcode( $content ) : TestHashItem::getString( $atts, 'value', null );
		unset( $atts[ 'id' ], $atts[ 'value' ] );
		return ( $id !== null && $content !== null ) ? ( string )( new WPMediaLink( intval( $id ), $content, $atts ) ) : '';
	}
);

function makeEmptyArrayIfNotArray( $array ) : array
{
	return ( is_array( $array ) ) ? $array : [];
}
