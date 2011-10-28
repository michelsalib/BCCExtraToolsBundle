<?php

namespace BCC\ExtraToolsBundle\Util\UnitConverter;

/**
 * Description of BaseRatioUnitProvider
 *
 * @author michel
 */
abstract class BaseRatioUnitProvider implements RatioUnitProviderInterface {
    
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
            'd'  => 0.1,
            'c'  => 0.01,
            'm'  => 0.001,
            'μ'  => 0.000001,
            'n'  => 0.000000001,
            'p'  => 0.000000000001,
            'f'  => 0.000000000000001,
            'a'  => 0.000000000000000001,
            'z'  => 0.000000000000000000001,
            'y'  => 0.000000000000000000000001,
        );
    }
}

