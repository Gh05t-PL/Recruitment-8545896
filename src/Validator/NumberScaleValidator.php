<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NumberScaleValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint NumberScale */

        if ( null === $value || '' === $value ) {
            return;
        }

        if ( $this->getDecCount((float)$value) > $constraint->scale ) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }

    private function getDecCount($f)
    {
        $num = 0;
        while ( true ) {
            if ( (string)$f === (string)round($f) ) {
                break;
            }
            if ( is_infinite($f) ) {
                break;
            }

            $f *= 10;
            $num++;
        }
        return $num;
    }
}
