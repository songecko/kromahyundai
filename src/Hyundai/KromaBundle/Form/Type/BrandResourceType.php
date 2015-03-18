<?php

namespace Hyundai\KromaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BrandResourceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('brand', 'entity', array(
        		'class'    => 'HyundaiKromaBundle:Brand',
        		'label'    => 'Product'
        ))
        ->add('category', 'entity', array(
        		'class'    => 'HyundaiKromaBundle:BrandResourceCategory',
        		'label'    => 'Category'
        ))
        ->add('name', 'text', array(
        		'required' => true,
        		'label'    => 'Name'
        ));
    }

    public function getName()
    {
        return 'hyundai_brandresource';
    }
}
