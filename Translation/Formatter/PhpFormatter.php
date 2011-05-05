<?php

namespace BCC\ExtraToolsBundle\Translation\Formatter;

class PhpFormatter implements FormatterInterface
{
    public function format(array $messages)
    {
        $output = "<?php\nreturn array(\n";
        foreach ($messages as $source => $target) {
            $output .= "    '".str_replace("'", "\\'", $source)."' => '".str_replace("'", "\\'", $target)."',\n";
        }
        $output .= ");";

        return $output;
    }
}