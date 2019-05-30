<?php

require_once( 'MockWordPress.php' );
use PHPUnit\Framework\TestCase;

class WordPressLinksTest extends TestCase
{
	public function testLink()
	{
        $this->assertEquals( '', do_shortcode( '[link]' ) );
        $this->assertEquals( '<a href="google.com">google.com</a>', do_shortcode( '[link]google.com[/link]' ) );
        $this->assertEquals( '<a href="google.com">google.com</a>', do_shortcode( '[link href="google.com"]' ) );
        $this->assertEquals( '<a href="google.com">Google</a>', do_shortcode( '[link href="google.com"]Google[/link]' ) );
        $this->assertEquals( '<a href="google.com">Google</a>', do_shortcode( '[link href="google.com" value="Google"]' ) );
		$complex_link = do_shortcode( '[link href="google.com" class="link" id="googlelink" external="true"]Google[/link]' );
        $this->assertStringContainsString( ' class="link"', $complex_link );
        $this->assertStringContainsString( ' id="googlelink"', $complex_link );
        $this->assertStringContainsString( ' href="google.com"', $complex_link );
        $this->assertStringContainsString( '">Google</a>', $complex_link );
        $this->assertStringContainsString( ' target="_blank"', $complex_link );
        $this->assertStringContainsString( 'noopener', $complex_link );
        $this->assertStringContainsString( 'noreferrer', $complex_link );
	}

	public function testMailLink()
	{
        $this->assertEquals( '', do_shortcode( '[mail-link]' ) );
        $this->assertEquals( '<a href="mailto:waughjai@gmail.com">waughjai@gmail.com</a>', do_shortcode( '[mail-link]waughjai@gmail.com[/mail-link]' ) );
        $this->assertEquals( '<a href="mailto:waughjai@gmail.com">waughjai@gmail.com</a>', do_shortcode( '[mail-link email="waughjai@gmail.com"]' ) );
        $this->assertEquals( '<a href="mailto:waughjai@gmail.com">Email Me</a>', do_shortcode( '[mail-link email="waughjai@gmail.com"]Email Me[/mail-link]' ) );
        $this->assertEquals( '<a href="mailto:waughjai@gmail.com">Email Me</a>', do_shortcode( '[mail-link mailto="waughjai@gmail.com"]Email Me[/mail-link]' ) );
		$complex_link = do_shortcode( '[mail-link email="waughjai@gmail.com" class="mail-link" id="mail-link-1"]Email Me[/mail-link]' );
        $this->assertStringContainsString( ' class="mail-link"', $complex_link );
        $this->assertStringContainsString( ' id="mail-link-1"', $complex_link );
        $this->assertStringContainsString( ' href="mailto:waughjai@gmail.com"', $complex_link );
        $this->assertStringContainsString( '">Email Me</a>', $complex_link );
	}

	public function testPhoneLink()
	{
        $this->assertEquals( '', do_shortcode( '[phone-link]' ) );
        $this->assertEquals( '<a href="tel:2222222222">2222222222</a>', do_shortcode( '[phone-link]2222222222[/phone-link]' ) );
        $this->assertEquals( '<a href="tel:2222222222">(222)-222-2222</a>', do_shortcode( '[phone-link](222)-222-2222[/phone-link]' ) );
        $this->assertEquals( '<a href="tel:2222222222">Call us now!</a>', do_shortcode( '[phone-link phone="2222222222"]Call us now![/phone-link]' ) );
        $this->assertEquals( '<a href="tel:2222222222">Call us now!</a>', do_shortcode( '[phone-link tel="2222222222"]Call us now![/phone-link]' ) );
		$complex_link = do_shortcode( '[phone-link tel="1234613212" class="call" id="call-2"]Give us a ring[/phone-link]' );
        $this->assertStringContainsString( ' class="call"', $complex_link );
        $this->assertStringContainsString( ' id="call-2"', $complex_link );
        $this->assertStringContainsString( ' href="tel:1234613212"', $complex_link );
        $this->assertStringContainsString( '">Give us a ring</a>', $complex_link );
	}

	public function testPostLink()
	{
        $this->assertEquals( '', do_shortcode( '[post-link]' ) );
        $this->assertEquals( '<a href="https://www.google.com">Google</a>', do_shortcode( '[post-link post_id="1"]' ) );
        $this->assertEquals( '<a href="https://www.google.com">Search</a>', do_shortcode( '[post-link post_id="1"]Search[/post-link]' ) );
        $this->assertEquals( '<a href="https://www.google.com">Google</a>', do_shortcode( '[post-link slug="google"]' ) );
        $this->assertEquals( '<a href="https://www.google.com">Search</a>', do_shortcode( '[post-link slug="google"]Search[/post-link]' ) );
        $this->assertEquals( '<a href="https://www.google.com">Google</a>', do_shortcode( '[post-link post_title="Google"]' ) );
        $this->assertEquals( '<a href="https://www.google.com">Search</a>', do_shortcode( '[post-link post_title="Google"]Search[/post-link]' ) );
		$complex_link = do_shortcode( '[post-link post_title="Google" title="Lookup" class="glink" id="glink1" external="true"]Search[/post-link]' );
        $this->assertStringContainsString( ' class="glink"', $complex_link );
        $this->assertStringContainsString( ' id="glink1"', $complex_link );
        $this->assertStringContainsString( ' href="https://www.google.com"', $complex_link );
		$this->assertStringContainsString( ' title="Lookup"', $complex_link );
        $this->assertStringContainsString( '">Search</a>', $complex_link );
        $this->assertStringContainsString( ' target="_blank"', $complex_link );
        $this->assertStringContainsString( 'noopener', $complex_link );
        $this->assertStringContainsString( 'noreferrer', $complex_link );
	}

	public function testTagLink()
	{
        $this->assertEquals( '', do_shortcode( '[tag-link]' ) );
        $this->assertEquals( '<a href="https://www.google.com">Google</a>', do_shortcode( '[tag-link slug="google"]' ) );
	}

	public function testCategoryLink()
	{
        $this->assertEquals( '', do_shortcode( '[category-link]' ) );
        $this->assertEquals( '<a href="https://www.google.com">Google</a>', do_shortcode( '[category-link slug="google"]' ) );
        $this->assertEquals( '<a href="https://www.jaimeson-waugh.com">Jaimeson</a>', do_shortcode( '[category-link category_id="1"]' ) );
        $this->assertEquals( '', do_shortcode( '[category-link category_id="44"]' ) );
	}

	public function testHomeLink()
	{
        $this->assertEquals( '<a href="https://www.jaimeson-waugh.com">Jaimeson Waugh</a>', do_shortcode( '[home-link]' ) );
        $this->assertEquals( '<a href="https://www.jaimeson-waugh.com">My Site</a>', do_shortcode( '[home-link]My Site[/home-link]' ) );
        $this->assertEquals( '<a href="https://www.jaimeson-waugh.com">My Site</a>', do_shortcode( '[home-link value="My Site"]' ) );
	}

	public function testMediaLink()
	{
        $this->assertEquals( '', do_shortcode( '[media-link]' ) );
	}
}
