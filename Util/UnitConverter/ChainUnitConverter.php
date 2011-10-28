<?php

namespace BCC\ExtraToolsBundle\Util\UnitConverter;

/**
 * Description of ChainUnitConverter
 *
 * @author michel
 */
class ChainUnitConverter implements UnitConverterInterface
{
    protected $converter = array();
    
    public function registerConverter(UnitConverterInterface $converter)
    {
        $this->converter[] = $converter;
    }
    
    /**
     *Tries to guess the source unit by parsing the string and then apply a convertion.
     * 
     * Returns null if fails or not supported.
     * 
     * @param string $value
     * @param string $destinationUnit
     * @param string the locale (optional)
     * 
     * @return mixed The converted value 
     */
    public function guessConvert($value, $destinationUnit, $locale = null)
    {
        if (preg_match('#([\d,\.\s]+)\s*([^\s]+)#', $value, $result) > 0) {
            
            return $this->convert(\floatval(\str_replace(array(',', ' '), array('.', ''), $result[1])), $result[2], $destinationUnit, $locale);
        }
        
        return null;
    }
    
    /**
     * {@inheritDoc}
     */
    public function convert($value, $sourceUnit, $destinationUnit, $locale = null)
    {
        $sourceUnit = \trim($sourceUnit, ' .');
        $destinationUnit = \trim($destinationUnit, ' .');
        
        foreach ($this->converter as $converter) {
            if (null !== $result = $converter->convert($value, $sourceUnit, $destinationUnit, $locale)) {
                return $result;
            }
        }
        
        return null;
    }
}
