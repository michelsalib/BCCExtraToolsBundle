<?php

namespace BCC\ExtraToolsBundle\Util\UnitConverter\Extension\fr;

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
            'p'      => 0.0254,
            'po'     => 0.0254,
            'pouce'  => 0.0254,
            'pouces' => 0.0254,
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getLocale() {
        return 'fr';
    }

    public function getUnit() {
        return self::LENGTH;
    }
}
