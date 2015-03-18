<?php

namespace Hyundai\KromaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BrandResourceFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', 'text', array(
        		'required'    => false,
        		'disabled'    => true,
        		'label'    => 'Filename'
        ))
        ->add('brandResource', 'entity', array(
        		'class'    => 'HyundaiKromaBundle:BrandResource',
        		'label'    => 'Resource'
        ))
        ->add('file', 'file', array(
        		'required' => false,
        		'label'    => 'File'
        ));
    }

    public function getName()
    {
        return 'hyundai_brandresourcefile';
    }
}
