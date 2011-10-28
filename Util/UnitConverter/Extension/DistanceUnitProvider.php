<?php

namespace BCC\ExtraToolsBundle\Util\UnitConverter\Extension;

use BCC\ExtraToolsBundle\Util\UnitConverter\BaseRatioUnitProvider;

/**
 * Description of DistanceUnitProvider
 *
 * @author michel
 */
class DistanceUnitProvider extends BaseRatioUnitProvider {
    
    /**
     * {@inheritDoc}
     */
    public function getRatios() {
        return array(
            'm'  => 1,
            '"'  => 0.0254,
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
        return self::LENGTH;
    }
}
