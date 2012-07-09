<?php

namespace BCC\ExtraToolsBundle\Twig;

use Symfony\Component\Locale\Locale;
use Symfony\Component\Translation\TranslatorInterface;

use BCC\ExtraToolsBundle\Util\DateFormatter;
use BCC\ExtraToolsBundle\Util\UnitConverter\UnitConverterInterface;

/**
 * The twig extensions of the BCC bundle
 * Has a dependency to the apache intl module
 */
class TwigExtension extends \Twig_Extension
{
    protected $converter;
    protected $translator;

    public function setUnitConverter(UnitConverterInterface $converter)
    {
        $this->converter  = $converter;
    }
    
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
    
    public function getFilters()
    {
        return array(
            'country'     => new \Twig_Filter_Function('\BCC\ExtraToolsBundle\Twig\TwigExtension::countryFilter'),
            'localeDate'  => new \Twig_Filter_Function('\BCC\ExtraToolsBundle\Twig\TwigExtension::localeDateFilter'),
            'convertUnit' => new \Twig_Filter_Method($this, 'convertFilter'),
        );
    }
    
    /**
     * Translate a country indicator to its locale full name
     * Uses default system locale by default. Pass another locale string to force a different translation
     *
     * @param string $country The contry indicator
     * @param string $default The default value is the country does not exist (optionnal)
     * @param mixed $locale
     * @return string The localized string
     */
    public static function countryFilter($country, $default = '', $locale = null)
    {
        $locale    = $locale == null ? \Locale::getDefault() : $locale;
        $countries = Locale::getDisplayCountries($locale);
        
        return array_key_exists($country, $countries) ? $countries[$country] : $default;
    }

    /**
     * Translate a timestamp to a localized string representation.
     * Parameters dateType and timeType defines a kind of format. Allowed values are (none|short|medium|long|full).
     * Default is medium for the date and no time.
     * Uses default system locale by default. Pass another locale string to force a different translation.
     * You might not like the default formats, so you can pass a custom pattern as last argument.
     *
     * @param mixed $date
     * @param string $dateType
     * @param string $timeType
     * @param mixed $locale
     * @param string $pattern
     *
     * @return string The string representation
     */
    public static function localeDateFilter($date, $dateType = 'medium', $timeType = 'none', $locale = null, $pattern = null)
    {
        $formatter = new DateFormatter();
        
        return $formatter->format($date, $dateType, $timeType, $locale, $pattern);
    }

    /**
     * Convert a value into another unit.
     * Returns null if fails or not supported.
     *
     * @param mixed $value
     * @param string $sourceUnit
     * @param string $destinationUnit
     * @param string the locale (optional)
     *
     * @return string|null The converted value
     */
    public function convertFilter($value, $sourceUnit, $destinationUnit, $unitName, $locale = null)
    {
        if (null !== $value) {
            $translatedUnitName = $this->translator->trans($unitName, array(), 'BCCExtraToolsBundle');

            $value = $this->converter->convert($value, $sourceUnit, $destinationUnit, $locale);
            $value = $value . ' ' . $translatedUnitName;
        }

        return $value;
    }
    
    public function getName()
    {
        return 'bcc';
    }
}
