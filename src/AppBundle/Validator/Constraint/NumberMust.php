<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 29.05.17
 * Time: 11:26
 */

namespace AppBundle\Validator\Constraint;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NumberMust extends Constraint
{
    public $message = 'Ciąg znaków "%string%" musi zawierać cyfrę';
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}