<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppointmentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class, array(
                'widget' => "single_text",
                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'ng-model' => 'newAppointment.date'
                )
            ))
            ->add('rental_property', ChoiceType::class, array(
                'choices' => array(
                    'Yes' => 'Yes',
                    'No' => 'No'
                ),
                'choices_as_values' => true,

                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'ng-model' => 'newAppointment.rental_property'
                )
            ))
            ->add('owner', ChoiceType::class, array(
                'choices' => array(
                    'Yes' => 'Yes',
                    'No' => 'No'
                ),
                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'ng-model' => 'newAppointment.owner'
                )
            ))
            ->add('notes', TextType::class, array(
                'translation_domain' => 'AppBundle',
                'attr' => array(
                    'ng-model' => 'newAppointment.notes'
                )
            ))
            ->add('customer', EntityType::class, array(
                'class' => 'AppBundle\Entity\Customer',
                'choice_label' => 'email',
                'attr' => array(
                    'ng-model' => 'newAppointment.customer'
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
            //'data_class' => 'AppBundle\Entity\Appointment',
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'appointment';
    }
}
