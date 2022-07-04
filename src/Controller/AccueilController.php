<?php


namespace App\Controller;
use App\Entity\User;
use App\Entity\Voyages;
use App\Entity\Reservation;
use App\Form\SearchDataType;
use App\Form\RegistrationFormType;
use App\Form\ReservationFrontType;
use App\Repository\UserRepository;
use App\Recherche\VoyageSearchData;
use App\Repository\LignesRepository;
use App\Repository\VoyagesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EnregistrementVehiculeRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AccueilController extends AbstractController
{
    /**
     * @Route("/",name="index")
     */
    public function index(Request $request, VoyagesRepository $voyagesRepository)
    {
        $searchData = new VoyageSearchData();
       
      
        $form = $this->createForm(SearchDataType::class,  $searchData);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 
            $depart =  $form->get('depart')->getData();
            $destination =  $form->get('destination')->getData();
            $date="";
           
            $result = $voyagesRepository->recherchesVoyages($depart->getId(),$destination->getId(), $date);

            return $this->render('front/liste-voyages-encours.html.twig',[
                "voyages"=> $result
            ]);
            // dd( $result);
           
        }
        return $this->render('front/index.html.twig',[
            'searchData'=> $searchData,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/obtenir-un-ticket",name="obtenir_ticket")
     */
    public function obtenirTicket(VoyagesRepository $voyagesRepository)
    {
        $voyages = $voyagesRepository->findAll();
        return $this->render('front/liste-voyages-encours.html.twig',[
            "voyages"=>$voyages
        ]);
    }

    /**
     * @Route("/reserver-mon-ticket/{id}",name="reserver_ticket", methods={"GET","POST"})
     */
    public function reserverTicket(Request $request, Voyages $voyages,VoyagesRepository $voyagesRepository,SessionInterface $session): Response
    {
        $reservation = new Reservation();
       
        $voyage_ligne = $voyages->getLigne()->getId();
        $form = $this->createForm(ReservationFrontType::class, $reservation,[
            'voyage_ligne'=>$voyage_ligne
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $reservation->setVoyage($voyages);
            $session->set('reservation', $reservation);
            $session->set('ligne',$voyage_ligne);
            $session->set('voyage',$voyages);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('confirmation_reservation', [], Response::HTTP_SEE_OTHER);
        }

        // return $this->renderForm('admin/reservation/new.html.twig', [
        //     'reservation' => $reservation,
        //     'form' => $form,
        // ]);

        // $voyages = $voyagesRepository->findAll();
        return $this->render('front/reservation-ticket.html.twig',[
            'reservation' => $reservation,
            'voyages'=> $voyages,
            'form' => $form->createView()
        ]);
    }
     /**
     * @Route("/confirmation-reservation",name="confirmation_reservation", methods={"GET","POST"})
     */
    public function confirmationReservation(Request $request,SessionInterface $session,LignesRepository $ligned, UserPasswordHasherInterface $userPasswordHasherInterface,EnregistrementVehiculeRepository $enregistrementVehiculeRepository){
        $reservation = $session->get('reservation', []);
        $vo = $session->get('voyage', []);
                $bus = $enregistrementVehiculeRepository->find($vo->getBus()->getId());
          


        $ligne = $ligned->find($session->get('ligne')) ;
        $vo->setLigne($ligne);
        $vo->setBus($bus);

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            // encode the plain password
            $user->setPassword(
            $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $reservation->setUser($user);
           
            $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($user);
            // $entityManager->persist($reservation);
            // $entityManager->flush();
            
            $session->set('reservation', $reservation);
            $session->set('user', $user);
            dd($reservation,$vo,$bus);
            return $this->redirectToRoute('confirmation_reservation_termine', [], Response::HTTP_SEE_OTHER);
        }
           
       
        //  dd(($ligne));
        return $this->render('front/confirmation-reservation.html.twig',[
            'reservation' => $reservation,
            'ligne'=>$ligne,
            'registrationForm' => $form->createView(),
            // 'voyages'=> $voyages,
            // 'form' => $form->createView()
        ]);
    }


 /**
     * @Route("/reservation-termine",name="confirmation_reservation_termine", methods={"GET","POST"})
     */

     public function terminateReservation(SessionInterface $session){
        $reservation = $session->get('reservation', []);
        $user = $session->get('user', []);
        // dd($user,$reservation);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->persist($reservation);
        $entityManager->flush();

     }
}