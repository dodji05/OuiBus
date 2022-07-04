<?php

namespace App\Controller\ajax;

use App\Entity\Voyages;
use App\Form\ReservationType;
use App\Repository\EscalesRepository;
use App\Repository\LignesRepository;
use App\Repository\VoyagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/requete-ajax")
 */
class InfosVoyagesController extends AbstractController
{
    /**
     * @Route("/voyages-encours/{id}", name="ajax_info_voyages_reservation")
     */
    public function infosVoyages(VoyagesRepository $voyagesrepository, Voyages $voyage)
    {
        $inofsvpyage = $voyagesrepository->infosVoyages($voyage->getId());
        $data = array();
        $data = [
            "dateDepart" => $voyage->getDateDepart(),
            "depart" => $voyage->getLigne()->getVilleDepart()->getNomVille(),
            "destination" => $voyage->getLigne()->getVilleArrive()->getNomVille(),
            "nbre_place" => $voyage->getBus()->getTypeVehicule()->getNbreSiege(),
            "bus" => $voyage->getBus()->getNumeroVehicule(),
        ];
//    dd($data);

        $response = array('success' => true, 'data' => $data, 'message' => '');
        $js = new JsonResponse($response);
        $js->headers->set("X-Content-Type-Options", "nosniff");
        $js->headers->set("Access-Control-Allow-Headers", ["Authorization, Content-Disposition, Content-MD5, Content-Type"]);
        return $js;
    }

    /**
     * @Route("/prix-escale/{ligneid}/{depart}/{arrive}", name="ajax_info_prix_escale")
     */
    public function infosPrixEscaleVoyages(EscalesRepository $escalesRepository, Request $request)
    {
        $ligneid = $request->get('ligneid');
        $departid = $request->get('depart');
        $arriveid = $request->get('arrive');

        $infoPrice = $escalesRepository->findOneBy(['ligne' => $ligneid, 'VilleDepart' => $departid, 'VilleArrive' => $arriveid]);

      //  dd($infoPrice);
        $data = [
            "price" => $infoPrice->getPrix(),
            "id" => $infoPrice->getId(),
        ];
        $response = array( $data);
        $js = new JsonResponse($data);
        $js->headers->set("X-Content-Type-Options", "nosniff");
        $js->headers->set("Access-Control-Allow-Headers", ["Authorization, Content-Disposition, Content-MD5, Content-Type"]);
        return $js;

    }

    /**
     * @Route("/infos-escale/{type}/{id}", name="ajax_filtre_quartier")
     */
    public function index(Request $request,LignesRepository $lignesRepository,VoyagesRepository $voyagesRepository): Response
    {
       $vl = $voyagesRepository->voyageVilleDepart(1);
     //  dd($vl);

        $em = $this->getDoctrine();

        $type = $request->get('type');
        $id = $request->get('id');
        if ($type === 'ligne') {
            $Resultat = $voyagesRepository->voyageVilleDepart( $id) ;

            //  $foreign = 'region_id';
        } else if ($type === 'arrondissement') {
            $Resultat = $em->getRepository('App:Arrondissement')->findBy(['Commune'=>$id]);
            //  $foreign =  'department_id';
        }
        else if ($type === 'quartier') {
            $Resultat = $em->getRepository('App:Quartier')->findBy(['arrondissement'=>$id]);
            //  $foreign =  'department_id';
        }
        else if ($type === 'vente'){
            // throw new Exception('Unknown type ' . $type);
            if($id == 1){
                $Resultat = $em->getRepository('App:ProprieteType')->findBy(['type'=>$id]);
            } else {
                $Resultat = $em->getRepository('App:ProprieteType')->findAll();
            }

        }
        else {

        }
//        if($Resultat)
//        {
//            $response = array("success" => true,
//            // "code"=>$code,
//           // 'prix'=>$produit->getPrix(),
//           // 'label' => $Resultat->getLibelle(),
//            'value' => $Resultat['id']
//
//             );
//        }


        foreach ($Resultat as $item){

                $data[] = [
                    'label' => $item->getLigne(),
                    'value'=> $item->getId()

                ];



        }
        // dd($type,$id,$Resultat,$data);

        return new Response(json_encode($data));
        // return json_encode($Resultat);

        dd($type,$id,$Resultat);
        return $this->render('ajax/index.html.twig', [
            'controller_name' => 'AjaxController',
        ]);
    }
}