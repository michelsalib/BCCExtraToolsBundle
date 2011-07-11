<?php

namespace BCC\ExtraToolsBundle\Twig;

use Symfony\Component\Locale\Locale;

/**
 * The twig extensions of the BCC bundle
 * Has a dependency to the apache intl module
 */
class TwigExtension extends \Twig_Extension {
    
    public function getFilters() {
        return array(
            'country' => new \Twig_Filter_Function('\BCC\ExtraToolsBundle\Twig\TwigExtension::countryFilter'),
            'localeDate' => new \Twig_Filter_Function('\BCC\ExtraToolsBundle\Twig\TwigExtension::localeDateFilter'),
        );
    }
    
    /**
     * Translate a contry indicator to its locale full name
     * @param type $country The contry indicator
     * @return type The localized string
     */
    public static function countryFilter($country){
        $countries = Locale::getDisplayCountries(\Locale::getDefault());
        return $countries[$country];
    }
    
    /**
     * Translate a timestamp to a localized string representation.
     * Parameters dateType and timeType defines a kind of format. Allowed values are (none|short|medium|long|full).
     * Default is medium for the date and no time.
     * @param mixed $date
     * @param string $dateType
     * @param string $timeType
     * @return string The string representation
     */
    public static function localeDateFilter($date, $dateType = 'medium', $timeType = 'none'){
        $values = array(
            'none'   => \IntlDateFormatter::NONE,
            'short'  => \IntlDateFormatter::SHORT,
            'medium' => \IntlDateFormatter::MEDIUM,
            'long'   => \IntlDateFormatter::LONG,
            'full'   => \IntlDateFormatter::FULL,
        );
        $dateFormater = \IntlDateFormatter::create(\Locale::getDefault(), $values[$dateType], $values[$timeType]);
        return $dateFormater->format($date);
    }
    
    public function getName() {
        return 'bcc';
    }
}
