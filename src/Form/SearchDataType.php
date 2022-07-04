<?php

namespace App\Form;

use App\Recherche\VoyageSearchData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SearchDataType extends AbstractType {
     public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('depart', EntityType::class, [
                "class" => 'App\Entity\Ville',
                'label' => "Ville de départ",
                "choice_label" => 'NomVille',
                "placeholder" => "Ville de départ",
                "attr" => [
                    "class" => "form--control select2"
                ]
                ])
            ->add('destination', EntityType::class, [
                "class" => 'App\Entity\Ville',
                'label' => "Ville de destination",
                "choice_label" => 'NomVille',
                "placeholder" => "Ville de départ",
                "attr" => [
                    "class" => "form--control select2"
                ]
            ])
            ->add('date',null,[
                "attr" => [
                    "class" => "form--control datepicker"
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VoyageSearchData::class,
        ]);
    }
}