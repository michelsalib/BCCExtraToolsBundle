<?php

namespace BCC\ExtraToolsBundle\Util\UnitConverter\Extension;

use BCC\ExtraToolsBundle\Util\UnitConverter\BaseRatioUnitProvider;

/**
 * Description of DistanceUnitProvider
 *
 * @author michel
 */
class WeightUnitProvider extends BaseRatioUnitProvider {
    
    /**
     * {@inheritDoc}
     */
    public function getRatios() {
        return array(
            'g'   => 1,
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
        return self::WEIGHT;
    }
}
