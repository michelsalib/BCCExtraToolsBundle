<?php

namespace BCC\ExtraToolsBundle\Util\UnitConverter;

/**
 * RatioUnitConverter converts units that are strictly proportionnal.
 * For instance hours and seconds are proportionnal. F° and C° are not.
 *
 * @author michel
 */
class RatioUnitConverter implements UnitConverterInterface
{
    /**
     * First level is the types
     * - Second level is prefix
     * - - Last level it the ratio
     * @var array 
     */
    protected $prefixes = array();
    
    /**
     * First level is the types
     * - Second level is the locale
     * - - Third level is the unit name
     * - - - Last level is the ratio
     * @var array 
     */
    protected $ratios = array();
    
    public function registerRatioUnitProvider(RatioUnitProviderInterface $ratioUnitProviders)
    {
        // ratios
        if (!isset($this->ratios[$ratioUnitProviders->getUnit()])) {
            $this->ratios[$ratioUnitProviders->getUnit()] = array();
            $this->ratios[$ratioUnitProviders->getUnit()][''] = array();
        }
        
        if (!isset($this->ratios[$ratioUnitProviders->getUnit()][$ratioUnitProviders->getLocale()])) {
            $this->ratios[$ratioUnitProviders->getUnit()][$ratioUnitProviders->getLocale()] = array();
        }
        
        $this->ratios[$ratioUnitProviders->getUnit()][$ratioUnitProviders->getLocale()] = \array_merge(
            $this->ratios[$ratioUnitProviders->getUnit()][$ratioUnitProviders->getLocale()],
            $ratioUnitProviders->getRatios()
        );
        
        // prefixes
        if (!isset($this->prefixes[$ratioUnitProviders->getUnit()])) {
            $this->prefixes[$ratioUnitProviders->getUnit()] = array();
        }
        
        if (count($this->prefixes[$ratioUnitProviders->getUnit()]) > 0) {
            $this->prefixes[$ratioUnitProviders->getUnit()] = \array_intersect_key(
                $this->prefixes[$ratioUnitProviders->getUnit()],
                $ratioUnitProviders->getPrefixes()
            );
        }
        else {
            $this->prefixes[$ratioUnitProviders->getUnit()] = $ratioUnitProviders->getPrefixes();
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function convert($value, $sourceUnit, $destinationUnit, $locale = null)
    {
        if (!\is_float($value) && !\is_int($value)) {
            return null;
        }
        
        $locale = $locale ?: \Locale::getDefault();
        $sourceRatio = null;
        $destinationRatio = null;

        foreach ($this->ratios as $unitType => $unitTypeRatios) {
            $sourceRatio = null;
            $destinationRatio = null;
            
            $sourceRatio = $this->getRatio($unitType, $sourceUnit, $locale);
            $destinationRatio = $this->getRatio($unitType, $destinationUnit, $locale);
            
            if ($sourceRatio !== null && $destinationRatio !== null) {
                break;
            }
        }
        
        if ($sourceRatio === null || $destinationRatio === null) {
            return null;
        }
        
        return $value * $sourceRatio / $destinationRatio;
    }
    
    private function getRatio($unitType, $unit, $locale){
        $ratio = 1;
        
        foreach ($this->prefixes[$unitType] as $prefix => $prefixRatio) {
            if (\strlen($unit) > \strlen($prefix) && \strpos($unit, $prefix) === 0) {
                $ratio = $prefixRatio;
                $unit = \substr($unit, \strlen($prefix));
                break;
            }
        }
        
        if (isset($this->ratios[$unitType][$locale][$unit])) {
            return $this->ratios[$unitType][$locale][$unit] * $ratio;
        }
        else if (isset($this->ratios[$unitType][''][$unit])) {
            return $this->ratios[$unitType][''][$unit] * $ratio;
        }
        
        return null;
    }
}
