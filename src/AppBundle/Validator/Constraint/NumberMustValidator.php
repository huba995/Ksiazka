<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 29.05.17
 * Time: 11:32
 */

namespace AppBundle\Validator\Constraint;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NumberMustValidator extends ConstraintValidator
{

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {
        // TODO: Implement validate() method.
        if (!preg_match('/\d/', $value, $matches)) {
            //  Jeżeli używasz nowej wersji API walidacji 2.5
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();

            // Jeżel używasz starszej wersji API walicaji 2.4
            /*
            $this->context->addViolation(
                $constraint->message,
                array('%string%' => $value)
            );
            */
        }
    }
}