<?php

namespace BCC\ExtraToolsBundle\Validator;

use Symfony\Component\Validator\Constraint;

class Unique extends Constraint
{
    public $message = 'This value is already used';
    public $property;
    public $class;
    
    public function validatedBy()
    {
        return 'validator.unique';
    }
    
    public function requiredOptions()
    {
        return array();
    }
    
    public function getTargets()
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
