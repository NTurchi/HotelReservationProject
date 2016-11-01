<?php

namespace ResaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datearrivee', DateType::class, array(
                "label" => "Date d'arrivée : ",
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker']))
            ->add('datedepart', DateType::class, array(
                "label" => "Date de départ : ",
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'js-datepicker']))
            ->add('email', EmailType::class, array('label' => 'Email : '))
            ->add('nom', TextType::class, array('label' => 'Nom :'))
            ->add('prenom', TextType::class, array('label' => 'Prénom : '))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ResaBundle\Entity\Reservation'
        ));
    }
}
