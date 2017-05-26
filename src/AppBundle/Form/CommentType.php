<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 23.05.17
 * Time: 13:40
 */

namespace AppBundle\Form;


use AppBundle\Entity\Comments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
    parent::buildForm($builder, $options); // TODO: Change the autogenerated stub

    $builder
        ->add('comment',TextType::class,array('label'=>false,'required'=>false))
        ->add('dodaj',SubmitType::class)
        ;
}

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Comments::class,
        ));
    }
}