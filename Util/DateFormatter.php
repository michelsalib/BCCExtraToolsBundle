<?php

namespace BCC\ExtraToolsBundle\Util;

/**
 * Description of DateFormater
 *
 * @author michel
 */
class DateFormatter {
    
    protected $formats = array(
        'full'   => \IntlDateFormatter::FULL,
        'long'   => \IntlDateFormatter::LONG,
        'medium' => \IntlDateFormatter::MEDIUM,
        'short'  => \IntlDateFormatter::SHORT,
        'none'   => \IntlDateFormatter::NONE,
    );
    
    /**
     * Parse a string representation of a date to a \DateTime
     * 
     * @param string $date
     * @param string $locale
     * @return \DateTime datetime
     * 
     * @throws \Exception If fails parsing the string
     */
    public function parse($date, $locale = null)
    {
        $result = new \DateTime();
        $result->setTimestamp($this->parseTimestamp($date, $locale));
        
        return $result;
    }
    
    /**
     * Translate a timestamp to a localized string representation.
     * Parameters dateType and timeType defines a kind of format. Allowed values are (none|short|medium|long|full).
     * Default is medium for the date and no time.
     * Uses default system locale by default. Pass another locale string to force a different translation
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
    public function format($date, $dateType = 'medium', $timeType = 'none', $locale = null, $pattern = null)
    {	
        $dateFormater = \IntlDateFormatter::create($locale ?: \Locale::getDefault(), $this->formats[$dateType], $this->formats[$timeType], date_default_timezone_get(), null, $pattern);
        
        if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50304) {
            $date = $date->getTimestamp();
        }

        return $dateFormater->format($date);
    }
    
    /**
     * Parse a string representation of a date to a timestamp.
     * 
     * @param string $date
     * @param string $locale
     * @return int Timestamp
     * 
     * @throws \Exception If fails parsing the string
     */
    private function parseTimestamp($date, $locale = null) {
        // try time default formats
        foreach ($this->formats as $timeFormat) {
            // try date default formats
            foreach($this->formats as $dateFormat) {
                $dateFormater = \IntlDateFormatter::create($locale ?: \Locale::getDefault(), $dateFormat, $timeFormat, date_default_timezone_get());
                $timestamp = $dateFormater->parse($date);
                
                if ($dateFormater->getErrorCode() == 0) {
                    return $timestamp;
                }
            }
        }
        
        // try other custom formats
        $formats = array(
            'MMMM yyyy', // november 2011 - nov. 2011
        );
        foreach($formats as $format) {
            $dateFormater = \IntlDateFormatter::create($locale ?: \Locale::getDefault(), $this->formats['none'], $this->formats['none'],  date_default_timezone_get(), \IntlDateFormatter::GREGORIAN, $format);
            $timestamp = $dateFormater->parse($date);
            
            if ($dateFormater->getErrorCode() == 0) {
                return $timestamp;
            }
        }
        
        throw new \Exception('"'.$date.'" could not be converted to \DateTime');
    }
}
