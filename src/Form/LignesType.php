<?php

namespace App\Form;

use App\Entity\Lignes;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LignesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomLigne', TextType::class, [
                "label" => "Nom de la ligne",
                "attr" => [
                    "placeholder" => "Nom de la ligne",

                ]
            ])
            ->add('VilleDepart', EntityType::class, [
                "class" => 'App\Entity\Ville',
                'label' => "Ville de départ",
                "choice_label" => 'NomVille',
                "placeholder" => "Ville de départ",
                "attr" => [
                    "class" => "form-control tokenfield"
                ]
            ])
            ->add('VilleArrive', EntityType::class, [
                "class" => 'App\Entity\Ville',
                'label' => "Ville d\'arrivé",
                "choice_label" => 'NomVille',
                "placeholder" => 'Ville d\'arrivé',
                "attr" => [
                    "class" => "form-control tokenfield"
                ]
            ])
            ->add('Arrets', EntityType::class, [
                "class" => 'App\Entity\Ville',
                'label' => "Points d\'arrets",
                "choice_label" => 'NomVille',
                "mapped" => false,
                "placeholder" => "Poins d\'arrets",
                'expanded' => true,
                'multiple' => true,
                "attr" => [
                    "class" => "form-control tokenfield"
                ]

            ])
            ->add('Status', ChoiceType::class, [
                'choices' => [
                'Active' => true,
                'Inactive' => false,
            ],
                "label_attr" => [
                    "class" => "radio-inline"
                ],
                'expanded' => true,
                'multiple' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lignes::class,
        ]);
    }
}
