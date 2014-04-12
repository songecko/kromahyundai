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
        ->add('brandResource', 'entity', array(
        		'class'    => 'HyundaiKromaBundle:BrandResource',
        		'label'    => 'Recurso'
        ))
        ->add('file', 'file', array(
        		'required' => false,
        		'label'    => 'Archivo'
        ))
        ->add('type', 'choice', array(
        		'required' => true,
        		'label'    => 'Tipo',
        		'choices'  => array('image' => 'Imagen', 'video' => 'Video', 'file' => 'Archivo')
        ));
    }

    public function getName()
    {
        return 'hyundai_brandresourcefile';
    }
}
