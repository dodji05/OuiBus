<?php

namespace App\Form;

use App\Entity\EnregistrementVehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnregistrementVehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NumeroVehicule', TextType::class,[
                "label"=>"N° vehicule",
                "attr"=>[
                    "placeholder"=>"numero du vehicule",

                ]
            ])
            ->add('TypeVehicule',EntityType::class,[
                "class"=>'App\Entity\TypeVehicule',
                "choice_label"=>'type',
                 "placeholder"=>"Type de vehicule",
            ])
            ->add('NumeroMoteur', TextType::class,[
                "label"=>"N° moteur",
                "attr"=>[
                    "placeholder"=>"numero du moteur",

                ]
            ])
            ->add('NumeroChassis', TextType::class,[
                "label"=>"N° chassis",
                "attr"=>[
                    "placeholder"=>"Numéro du chassis",

                ]
            ])
            ->add('Marque', TextType::class,[
                "label"=>"Marque",
                "attr"=>[
                    "placeholder"=>"Marque du vehicule",

                ]
            ])

            ->add('Model', TextType::class,[
                "label"=>"Model",
                "attr"=>[
                    "placeholder"=>"Model du vehicule",

                ]
            ])
            ->add('status',null,[
                "label"=>"Active"
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EnregistrementVehicule::class,
        ]);
    }
}
