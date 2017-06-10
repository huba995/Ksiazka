<?php
/**
 * Created by PhpStorm.
 * User: hubert
 * Date: 27.05.17
 * Time: 16:16
 */

namespace AppBundle\Form;



use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options); // TODO: Change the autogenerated stub

        $builder
            ->add('email',TextType::class,array('label'=>'Email','required'=>false))
            ->add('password',TextType::class,array('label'=>'Hasło','required'=>false))
            ->add('zaloguj',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver); // TODO: Change the autogenerated stub
        $resolver->setDefaults(['data_class'=>User::class]);
    }

}