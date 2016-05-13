<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class, array(
                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'ng-model' => 'newCustomer.first_name'
                )
            ))
            ->add('last_name', TextType::class, array(
                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'ng-model' => 'newCustomer.last_name'
                )
            ))
            ->add('address', TextType::class, array(
                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'ng-model' => 'newCustomer.address'
                )
            ))
            ->add('zip_code', TextType::class, array(
                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'ng-model' => 'newCustomer.zip_code'
                )
            ))
            ->add('cell_phone', TextType::class, array(
                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'ng-model' => 'newCustomer.cell_phone'
                )
            ))
            ->add('home_phone', TextType::class, array(
                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'ng-model' => 'newCustomer.home_phone'
                )
            ))
            ->add('email', EmailType::class, array(
                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'ng-model' => 'newCustomer.email'
                )
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            //'data_class' => 'AppBundle\Entity\Customer',
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'customer';
    }
}
