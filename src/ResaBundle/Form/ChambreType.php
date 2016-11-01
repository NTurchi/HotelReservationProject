<?php

namespace ResaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ChambreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numchambre', IntegerType::class, array("label" => "Numéro de la chambre"))
            ->add('places', IntegerType::class, array("label" => "Nombre de place : "))
            ->add('clim', CheckboxType::class, array("label" => "Climatisation ", 'required' => false))
            ->add('tv', CheckboxType::class, array("label" => "Tv ", 'required' => false))
            ->add('internet', CheckboxType::class, array("label" => "Internet", 'required' => false))
            ->add('animaux', CheckboxType::class, array("label" => "Animaux", 'required' => false));
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ResaBundle\Entity\Chambre'
        ));
    }
}
