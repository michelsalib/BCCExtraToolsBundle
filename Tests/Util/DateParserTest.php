<?php

namespace BCC\ExtraToolsBundle\Tests\Util;

use BCC\ExtraToolsBundle\Util\DateFormatter;

/**
 * Description of DateParserTests
 *
 * @author michel
 */
class DateParserTest extends \PHPUnit_Framework_TestCase {

    public function testParse() {
        // ARRANGE
        $formater = new DateFormatter();
        
        // ACT - ASSERT
        $date = $formater->parse('1 Novembre 2009', 'fr');
        $this->assertEquals('1 novembre 2009', $formater->format($date, 'long', 'none', 'fr'));
        
        // ACT - ASSERT
        $date = $formater->parse('1 Nov. 2009', 'fr');
        $this->assertEquals('1 novembre 2009', $formater->format($date, 'long', 'none', 'fr'));
        
        // ACT - ASSERT
        $date = $formater->parse('1 Nov. 2009 10:00', 'fr');
        $this->assertEquals('1 novembre 2009 10:00', $formater->format($date, 'long', 'short', 'fr'));
        
        // ACT - ASSERT
        $date = $formater->parse('Novembre 2009', 'fr');
        $this->assertEquals('1 novembre 2009', $formater->format($date, 'long', 'none', 'fr'));
        
        // ACT - ASSERT
        $date = $formater->parse('Nov. 2009', 'fr');
        $this->assertEquals('1 novembre 2009', $formater->format($date, 'long', 'none', 'fr'));
        
        // ACT - ASSERT
        $date = $formater->parse('December 2009', 'en');
        $this->assertEquals('December 1, 2009', $formater->format($date, 'long', 'none', 'en'));
    }
}
