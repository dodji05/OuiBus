<?php

namespace App\Form;

use App\Entity\Escales;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EscalesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('NomEscale')
            ->add('ligne', EntityType::class, [
                "class" => 'App\Entity\Lignes',
                'label' => "la ligne direste",
                "choice_label" => 'NomLigne',
                "placeholder" => "Ligne",
                "attr" => [
                    "class" => "form-control tokenfield"
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
                "placeholder" => "Ville d\'arrivé",
                "attr" => [
                    "class" => "form-control tokenfield"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Escales::class,
        ]);
    }
}
