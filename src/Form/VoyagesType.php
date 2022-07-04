<?php

namespace App\Form;

use App\Entity\Voyages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VoyagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('DateDepart')
            ->add('HeureDepart')
            ->add('bus', EntityType::class, [
                "class" => 'App\Entity\EnregistrementVehicule',
                'label' => "Bus",
                "choice_label" => 'NumeroVehicule',
                "placeholder" => "Bus pour le voyage",
                "attr" => [
                    "class" => "form-control tokenfield"
                ]
            ])
         
            ->add('ligne', EntityType::class, [
                "class" => 'App\Entity\Lignes',
                'label' => "Ligne",
                "choice_label" => 'NomLigne',
                "placeholder" => "Ligne de voyage",
                "attr" => [
                    "class" => "form-control tokenfield"
                ]
            ])
            ->add('Status')
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voyages::class,
        ]);
    }
}
