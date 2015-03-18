<?php

namespace Hyundai\KromaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BrandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title', 'text', array(
        		'required' => true,
        		'label'    => 'Title'
        
        ))
        ->add('date', 'date', array(
        		'required' => true,
        		'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Dia'),
        		'format' => 'dd-MM-yyyy',
        		'years' => range(date('Y'), date('Y')+10),
        		'label'    => 'Date'
        
        ))
        ->add('description', 'textarea', array(
        		'required' => true,
        		'label'    => 'Description'
        
        ));
    }

    public function getName()
    {
        return 'hyundai_brand';
    }
}
