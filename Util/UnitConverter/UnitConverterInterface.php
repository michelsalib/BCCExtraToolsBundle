<?php

namespace BCC\ExtraToolsBundle\Util\UnitConverter;

/**
 * Description of UnitConverterInterface
 *
 * @author michel
 */
interface UnitConverterInterface
{
    /**
     * Convert a value into another unit.
     * Returns null if fails or not supported.
     * 
     * @param mixed $value
     * @param string $sourceUnit
     * @param string $destinationUnit
     * @param string the locale (optional)
     * 
     * @return mixed The converted value
     */
    public function convert($value, $sourceUnit, $destinationUnit, $locale = null);
}
