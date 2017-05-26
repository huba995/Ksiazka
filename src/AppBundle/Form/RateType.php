<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 23.05.17
 * Time: 14:53
 */

namespace AppBundle\Form;


use AppBundle\Entity\Recipes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options); // TODO: Change the autogenerated stub

        $builder
            ->add('plus',SubmitType::class)
            ->add('minus',SubmitType::class)
            ;

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver); // TODO: Change the autogenerated stub
        $resolver->setDefaults(['data_class'=>Recipes::class]);

    }
}