<?php

namespace BCC\ExtraToolsBundle\Tests\Util;

use BCC\ExtraToolsBundle\Util\UnitConverter\ChainUnitConverter;
use BCC\ExtraToolsBundle\Util\UnitConverter\RatioUnitConverter;
use BCC\ExtraToolsBundle\Util\UnitConverter\Extension;

/**
 * Description of DateParserTests
 *
 * @author michel
 */
class UnitConverterTest extends \PHPUnit_Framework_TestCase {

    public function testParsePrefix() {
        // ARRANGE
        $converter = new ChainUnitConverter();
        $ratioConverter = new RatioUnitConverter();
        $ratioConverter->registerRatioUnitProvider(new Extension\DistanceUnitProvider());
        $ratioConverter->registerRatioUnitProvider(new Extension\fr\DistanceUnitProvider());
        $converter->registerConverter($ratioConverter);
        
        // ACT - ASSERT
        $value = $converter->convert(1, 'km', 'm');
        $this->assertEquals(1000, (int)$value);
    }
    
    public function testConvertDistanceWithLocale() {
        // ARRANGE
        $converter = new ChainUnitConverter();
        $ratioConverter = new RatioUnitConverter();
        $ratioConverter->registerRatioUnitProvider(new Extension\DistanceUnitProvider());
        $ratioConverter->registerRatioUnitProvider(new Extension\fr\DistanceUnitProvider());
        $converter->registerConverter($ratioConverter);
        
        // ACT - ASSERT
        $value = $converter->convert(82, 'cm', 'p', 'fr');
        $this->assertEquals(32, (int)$value);
    }
    
    public function testConvertDistance() {
        // ARRANGE
        $converter = new ChainUnitConverter();
        $ratioConverter = new RatioUnitConverter();
        $ratioConverter->registerRatioUnitProvider(new Extension\TimeUnitProvider());
        $converter->registerConverter($ratioConverter);
        
        // ACT - ASSERT
        $value = $converter->convert(1, 'h', 's');
        $this->assertEquals(60*60, $value);
    }
    
    public function testConvertComputerCapacity() {
        // ARRANGE
        $converter = new ChainUnitConverter();
        $ratioConverter = new RatioUnitConverter();
        $ratioConverter->registerRatioUnitProvider(new Extension\ComputingCapacityUnitProvider());
        $converter->registerConverter($ratioConverter);
        
        // ACT - ASSERT
        $value = $converter->convert(1, 'Go', 'Mo');
        $this->assertEquals(1000, $value);
        
        // ACT - ASSERT
        $value = $converter->convert(1, 'o', 'B');
        $this->assertEquals(8, $value);
        
        // ACT - ASSERT
        $value = $converter->convert(1, 'GO', 'mo');
        $this->assertEquals(null, $value);
    }
    
    public function testConvertFrequency() {
        // ARRANGE
        $converter = new ChainUnitConverter();
        $ratioConverter = new RatioUnitConverter();
        $ratioConverter->registerRatioUnitProvider(new Extension\FrequencyUnitProvider());
        $converter->registerConverter($ratioConverter);
        
        // ACT - ASSERT
        $value = $converter->convert(1, 'GHz', 'MHz');
        $this->assertEquals(1000, $value);
    }

    public function testConvertFloat() {
        // ARRANGE
        $converter = new ChainUnitConverter();
        $ratioConverter = new RatioUnitConverter();
        $ratioConverter->registerRatioUnitProvider(new Extension\ComputingCapacityUnitProvider());
        $converter->registerConverter($ratioConverter);

        // ACT - ASSERT
        $value = $converter->convert(128, 'Mo', 'Go');
        $this->assertEquals(0.128, $value);
    }

    public function testParseDirtyUnits() {
        // ARRANGE
        $converter = new ChainUnitConverter();
        $ratioConverter = new RatioUnitConverter();
        $ratioConverter->registerRatioUnitProvider(new Extension\DistanceUnitProvider());
        $converter->registerConverter($ratioConverter);
        
        // ACT - ASSERT
        $value = $converter->convert(1, 'km.', 'm ');
        $this->assertEquals(1000, $value);
    }
    
    public function testGuessConvert() {
        // ARRANGE
        $converter = new ChainUnitConverter();
        $ratioConverter = new RatioUnitConverter();
        $ratioConverter->registerRatioUnitProvider(new Extension\DistanceUnitProvider());
        $converter->registerConverter($ratioConverter);
        
        // ACT - ASSERT
        $value = $converter->guessConvert('stub 1.5 km stub', 'm ');
        $this->assertEquals(1500, $value);
        
        // ACT - ASSERT
        $value = $converter->guessConvert('stub 1,5km stub', 'm ');
        $this->assertEquals(1500, $value);
        
        // ACT - ASSERT
        $value = $converter->guessConvert('stub1 250,5km', 'm ');
        $this->assertEquals(1250500, $value);
    }
}
