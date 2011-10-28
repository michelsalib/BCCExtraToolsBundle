<?php

namespace BCC\ExtraToolsBundle\Util\UnitConverter\Extension;

use BCC\ExtraToolsBundle\Util\UnitConverter\BaseRatioUnitProvider;

/**
 * Description of DistanceUnitProvider
 *
 * @author michel
 */
class ComputingCapacityUnitProvider extends BaseRatioUnitProvider {
    
    /**
     * {@inheritDoc}
     */
    public function getRatios() {
        return array(
            'o' => 1,
            'O' => 1,
            'b' => 1,
            'B' => 1/8,
        );
    }
    
    /**
     * {@inheritDoc}
     */
    public function getPrefixes() {
        return array (
            'Y'  => 1000000000000000000000000,
            'Z'  => 1000000000000000000000,
            'E'  => 1000000000000000000,
            'P'  => 1000000000000000,
            'T'  => 1000000000000,
            'G'  => 1000000000,
            'M'  => 1000000,
            'k'  => 1000,
            'h'  => 100,
            'da' => 10,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getLocale() {
        return '';
    }

    /**
     * {@inheritDoc}
     */
    public function getUnit() {
        return self::COMPUTING_CAPACITY;
    }
}
