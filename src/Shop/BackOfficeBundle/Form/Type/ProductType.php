<?php

namespace Shop\BackOfficeBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('ref', 'text')
                ->add('name', 'text')
                ->add('file')
                ->add('description', 'textarea')
                ->add('price', 'text', array('max_length' => 6))
                ->add('active', 'choice', array(
                    'choices' => array(
                        true => 'Activer',
                        false => 'Desactiver'
                    ),
                    'data' => true));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Shop\BackOfficeBundle\Entity\Product',
        ));
    }

    public function getName() {
        return 'product';
    }

}
