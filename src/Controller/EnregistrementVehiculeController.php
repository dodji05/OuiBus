<?php

namespace App\Controller;

use App\Entity\EnregistrementVehicule;
use App\Form\EnregistrementVehiculeType;
use App\Repository\EnregistrementVehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/enregistrement/vehicule")
 */
class EnregistrementVehiculeController extends AbstractController
{
    /**
     * @Route("/", name="enregistrement_vehicule_index", methods={"GET"})
     */
    public function index(EnregistrementVehiculeRepository $enregistrementVehiculeRepository): Response
    {
        return $this->render('enregistrement_vehicule/index.html.twig', [
            'enregistrement_vehicules' => $enregistrementVehiculeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="enregistrement_vehicule_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $enregistrementVehicule = new EnregistrementVehicule();
        $form = $this->createForm(EnregistrementVehiculeType::class, $enregistrementVehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($enregistrementVehicule);
            $entityManager->flush();

            return $this->redirectToRoute('enregistrement_vehicule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('enregistrement_vehicule/new.html.twig', [
            'enregistrement_vehicule' => $enregistrementVehicule,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="enregistrement_vehicule_show", methods={"GET"})
     */
    public function show(EnregistrementVehicule $enregistrementVehicule): Response
    {
        return $this->render('enregistrement_vehicule/show.html.twig', [
            'enregistrement_vehicule' => $enregistrementVehicule,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="enregistrement_vehicule_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EnregistrementVehicule $enregistrementVehicule): Response
    {
        $form = $this->createForm(EnregistrementVehiculeType::class, $enregistrementVehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enregistrement_vehicule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('enregistrement_vehicule/edit.html.twig', [
            'enregistrement_vehicule' => $enregistrementVehicule,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="enregistrement_vehicule_delete", methods={"POST"})
     */
    public function delete(Request $request, EnregistrementVehicule $enregistrementVehicule): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enregistrementVehicule->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enregistrementVehicule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enregistrement_vehicule_index', [], Response::HTTP_SEE_OTHER);
    }
}
