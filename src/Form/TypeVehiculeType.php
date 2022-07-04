<?php

namespace App\Form;

use App\Entity\TypeVehicule;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeVehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type', TextType::class,[
                "label"=>"Type vehicule",
                "attr"=>[
                    "placeholder"=>"type de vehicule",

                ]
            ])
            ->add('NbreSiege', IntegerType::class,[
                "label"=>"Place total",
                "attr"=>[
                    "placeholder"=>"nombre de siege total",

                ]
            ])
            ->add('Status',ChoiceType::class,[
                'choices'  => [
                    'Active' => true,
                    'Inactive' => false,
                ],
                'expanded'=> true,
                'multiple'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeVehicule::class,
        ]);
    }
}
