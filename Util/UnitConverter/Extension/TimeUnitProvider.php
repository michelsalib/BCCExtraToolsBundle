<?php

namespace BCC\ExtraToolsBundle\Util\UnitConverter\Extension;

use BCC\ExtraToolsBundle\Util\UnitConverter\BaseRatioUnitProvider;

/**
 * Description of DistanceUnitProvider
 *
 * @author michel
 */
class TimeUnitProvider extends BaseRatioUnitProvider {
    
    /**
     * {@inheritDoc}
     */
    public function getRatios() {
        return array(
            's'   => 1,
            'sec' => 1,
            'm'   => 60,
            'h'   => 60*60,
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
        return self::TIME;
    }
}
