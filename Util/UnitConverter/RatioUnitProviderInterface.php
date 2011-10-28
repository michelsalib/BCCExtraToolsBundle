<?php

namespace BCC\ExtraToolsBundle\Util\UnitConverter;

/**
 * Description of RatioUnitProviderInterface
 *
 * @author michel
 */
interface RatioUnitProviderInterface {
    
    const LENGTH = 1; // reference is the meter
    const WEIGHT = 2; // reference is the kilogram
    const TIME = 3; // referense is the second
    const ELECTRIC_CURRENT = 4; // default is the ampere
    const TEMPERATURE = 5; // default is the kelvin
    const LUMINUS_INTENSITY = 6; // default is the candela
    const AMOUNT_OF_SUBSTANCE = 7; // default is the mole
    const ANGLE = 8; // default is the radian
    const SURFACE = 9;
    const CURRENCY = 10;
    const PRESSURE = 11;
    const SPEED = 12; // default is meter per second
    const TIME_ZONE = 13; // default is GMT
    const VOLUME = 14;
    const FLOW = 15;
    const COMPUTING_CAPACITY = 16; // default is byte (or octet)
    const COMPUTING_FLOW = 17;
    const DENSITY = 18;
    const FREQUENCY = 19; // default is hertz
    
    /**
     * Returns an associative array from unit to its weight in the current unit
     * 
     * @return array The ratios
     */
    function getRatios();
    
    /**
     * Returns an associative array from prefix to its weight in the current unit
     * 
     * @return array The prefixes
     */
    function getPrefixes();
    
    /**
     * Returns the type of unit (distance, volume...) as defined in the current interface or other as string.
     * 
     * @return mixed The type of unit
     */
    function getUnit();
    
    /**
     * Returns the locale of the provider.
     * Empty string is internationnal.
     * 
     * @return string The locale
     */
    function getLocale();
}

