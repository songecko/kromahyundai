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
        		'label'    => 'Marca'
        ))
        ->add('category', 'entity', array(
        		'class'    => 'HyundaiKromaBundle:BrandResourceCategory',
        		'label'    => 'Categoria'
        ))
        ->add('name', 'text', array(
        		'required' => true,
        		'label'    => 'Nombre'
        ))
        ->add('file', 'file', array(
        		'required' => false,
        		'label'    => 'Recurso'
        ))
        ->add('type', 'choice', array(
        		'required' => true,
        		'label'    => 'Tipo',
        		'choices'  => array('image' => 'Imagen', 'video' => 'Video')
        ));
    }

    public function getName()
    {
        return 'hyundai_brandresource';
    }
}