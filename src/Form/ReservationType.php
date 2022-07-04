<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('voyage', EntityType::class, [
                "class" => 'App\Entity\Voyages',
                'label' => "Voyages",
                "choice_label" => 'NomVoyages',
                "placeholder" => "Ville de départ",
                "attr" => [
                    "class" => "form-control tokenfield",
                    "onchange" => "infosvoyages(event,this)",
                    'data-target' => "#reservation_VilleDepart",
                    'data-source' => "http://127.0.0.1:8000/requete-ajax/infos-escale/ligne/id",

                ]
            ])
            ->add('DateDepart', TextType::class, [
                "attr" => [
                    "class" => "form-control ",
                    'read_only' => true
                ],
                'mapped' => false
            ])
            ->add('LieuDepart', TextType::class, [
                "attr" => [
                    "class" => "form-control "
                ],
                'mapped' => false
            ])
            ->add('Destination', TextType::class, [
                "attr" => [
                    "class" => "form-control "
                ],
                'mapped' => false
            ])
            ->add('NbrePlace', TextType::class, [
                "attr" => [
                    "class" => "form-control "
                ],
                'mapped' => false
            ])
            ->add('PlaceDisponible', TextType::class, [
                "attr" => [
                    "class" => "form-control "
                ],
                'mapped' => false
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
        /*   ->add('VilleDepart', ChoiceType::class, [

               'placeholder' => 'Sélectionnez larrondissement',

               'required' => false,
//                'help'=>'GOGOUNOU, TOGOUDO',
//                'mapped' => false,
               'attr' => [
                   'class' => 'linked-select form-control tokenfield',
                   'data-target' => "#quartier",
                   'data-source' => "http://localhost:5050/ajax/quartier/id",



               ],
               'label_attr' => [
//                    'style'=>'display: none'
               ],
           ])*/

            ->add('VilleArrivee', EntityType::class, [
                "class" => 'App\Entity\Ville',
                'label' => "Ville de départ",
                "choice_label" => 'NomVille',
                "placeholder" => "Ville de départ",
                "attr" => [
                    "class" => "form-control tokenfield",
                    "onchange" => "prixEscale(event,this)"
                ]
            ])
          //  ->add('NumeroSiege')
            ->add('NbrePlace')
            ->add('passagers',PassagerType::class)
            ->add('Prix',null,[
                "label"=>"Prix du ticket"
            ])
            ->add('StatusPayement');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
