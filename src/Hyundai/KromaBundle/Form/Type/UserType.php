<?php

namespace Hyundai\KromaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', 'text', array(
        		'required' => true,
        		'label'    => 'Username'
        ))
        ->add('email', 'text', array(
        		'required' => true,
        		'label'    => 'Email'
        ))
        ->add('plainPassword', 'password', array(
        		'required' => true,
        		'label'    => 'Password'
        ))
        ->add('firstName', 'text', array(
        		'required' => true,
        		'label'    => 'First name'
        ))
        ->add('lastName', 'text', array(
        		'required' => true,
        		'label'    => 'Last name'
        ));
    }

    public function getName()
    {
        return 'hyundai_user';
    }
}
