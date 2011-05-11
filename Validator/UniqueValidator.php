<?php

namespace BCC\ExtraToolsBundle\Validator;

use Symfony\Component\Validator\ConstraintValidator;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Constraint;

class UniqueValidator extends ConstraintValidator
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function isValid($value, Constraint $constraint) {
        if ($constraint->property === null)
            $constraint->property = $this->context->getCurrentProperty();
        if ($constraint->class === null)
            $constraint->class = $this->context->getCurrentClass();
                
        $item = $this->entityManager->getRepository($constraint->class)->findOneBy(array($constraint->property => $value));
        
        if($item != null){
            $this->setMessage($constraint->message);
            return false;
        }
        return true;
    }
}
