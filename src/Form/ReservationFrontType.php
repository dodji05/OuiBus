<?php

namespace App\Form;

use App\Entity\Reservation;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationFrontType extends AbstractType
{
   protected $id;
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->id = $options['voyage_ligne'];
        $builder       
           
          
           
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
                "query_builder"=>function(EntityRepository $er){
                    return $er->createQueryBuilder('v')
                    ->innerJoin('v.escalesDepart','l')
                    ->innerJoin('l.ligne','es')
                    ->where('es.id = :val')
                    ->setParameter('val',  $this->id)
                    // ->innerJoin('e.VilleDepart','vd')
                    ;
                },
                "attr" => [
                    "class" => "form-control select2"
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
                "placeholder" => "Destination",
                "query_builder"=>function(EntityRepository $er){
                    return $er->createQueryBuilder('v')
                    ->innerJoin('v.escalesArrive','l')
                    ->innerJoin('l.ligne','es')
                    ->where('es.id = :val')
                    ->setParameter('val',  $this->id)
                    // ->innerJoin('e.VilleDepart','vd')voyage_ligne
                    ;
                },
                "attr" => [
                    "class" => "form-control select2",
                    "onchange" => "prixEscale(event,this)"
                ]
            ])
          //  ->add('NumeroSiege')
            // ->add('NbrePlace')
            // ->add('passagers',PassagerType::class)
            ->add('Prix',null,[
                "label"=>"Prix du ticket"
            ])
            // ->add('StatusPayement')
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'voyage_ligne'=> 0
        ]); 

        $resolver->setAllowedTypes('voyage_ligne','integer');
    }
}
