<?php

namespace BCC\ExtraToolsBundle\Twig;

use Symfony\Component\Locale\Locale;

/**
 * The twig extensions of the BCC bundle
 * Has a dependency to the apache intl module
 */
class TwigExtension extends \Twig_Extension {
    
    public function getFilters()
    {
        return array(
            'country'    => new \Twig_Filter_Function('\BCC\ExtraToolsBundle\Twig\TwigExtension::countryFilter'),
            'localeDate' => new \Twig_Filter_Function('\BCC\ExtraToolsBundle\Twig\TwigExtension::localeDateFilter'),
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
     * Uses default system locale by default. Pass another locale string to force a different translation
     *
     * @param mixed $date
     * @param string $dateType
     * @param string $timeType
     * @param mixed $locale
     * @return string The string representation
     */
    public static function localeDateFilter($date, $dateType = 'medium', $timeType = 'none', $locale = null)
    {
        $values = array(
            'none'   => \IntlDateFormatter::NONE,
            'short'  => \IntlDateFormatter::SHORT,
            'medium' => \IntlDateFormatter::MEDIUM,
            'long'   => \IntlDateFormatter::LONG,
            'full'   => \IntlDateFormatter::FULL,
        );
	
        $locale       = $locale == null ? \Locale::getDefault() : $locale;
        $dateFormater = \IntlDateFormatter::create($locale, $values[$dateType], $values[$timeType], date_default_timezone_get());
        
        if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50304) {
            $date = $date->getTimestamp();
        }

        return $dateFormater->format($date);
    }
    
    public function getName()
    {
        return 'bcc';
    }
}
