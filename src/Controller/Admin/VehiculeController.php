<?php

namespace App\Controller\Admin;

use App\Entity\EnregistrementVehicule;
use App\Entity\TypeVehicule;
use App\Form\EnregistrementVehiculeType;
use App\Form\TypeVehiculeType;
use App\Repository\EnregistrementVehiculeRepository;
use App\Repository\TypeVehiculeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/flotte")
 */
class VehiculeController extends AbstractController
{
    /**
     * @Route("/type/liste", name="flotte_type_vehicule_index", methods={"GET"})
     */
    public function index(TypeVehiculeRepository $typeVehiculeRepository): Response
    {
        return $this->render('admin/flotte/type/index.html.twig', [
            'type_vehicules' => $typeVehiculeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/type/new", name="flotte_type_vehicule_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeVehicule = new TypeVehicule();
        $form = $this->createForm(TypeVehiculeType::class, $typeVehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeVehicule);
            $entityManager->flush();
            $this->addFlash('success', 'Type de vehicule enregistrer avec success');
            return $this->redirectToRoute('flotte_type_vehicule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/flotte/type/new.html.twig', [
            'type_vehicule' => $typeVehicule,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/type/{id}", name="flotte_type_vehicule_show", methods={"GET"})
     */
    public function show(TypeVehicule $typeVehicule): Response
    {
        return $this->render('type_vehicule/show.html.twig', [
            'type_vehicule' => $typeVehicule,
        ]);
    }

    /**
     * @Route("/type/{id}/edit", name="flotte_type_vehicule_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeVehicule $typeVehicule): Response
    {
        $form = $this->createForm(TypeVehiculeType::class, $typeVehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('flotte_type_vehicule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_vehicule/edit.html.twig', [
            'type_vehicule' => $typeVehicule,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/type/{id}", name="flotte_type_vehicule_delete", methods={"POST"})
     */
    public function delete(Request $request, TypeVehicule $typeVehicule): Response
    {
        if ($this->isCsrfTokenValid('delete' . $typeVehicule->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeVehicule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('flotte_type_vehicule_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/enregistrement-flotte", name="flotte_enregistrement_vehicule_index", methods={"GET"})
     */
    public function indexEnregistrement(EnregistrementVehiculeRepository $enregistrementVehiculeRepository): Response
    {
        return $this->render('admin/flotte/enregistrement/index.html.twig', [
            'enregistrement_vehicules' => $enregistrementVehiculeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/enregistrement-flotte/new", name="flotte_enregistrement_vehicule_new", methods={"GET","POST"})
     */
    public function newEnregistrement(Request $request): Response
    {
        $enregistrementVehicule = new EnregistrementVehicule();
        $form = $this->createForm(EnregistrementVehiculeType::class, $enregistrementVehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($enregistrementVehicule);
            $entityManager->flush();

            return $this->redirectToRoute('flotte_enregistrement_vehicule_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/flotte/enregistrement/new.html.twig', [
            'enregistrement_vehicule' => $enregistrementVehicule,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/enregistrement-flotte/{id}", name="flotte_enregistrement_vehicule_show", methods={"GET"})
     */
    public function showEnregistrement(EnregistrementVehicule $enregistrementVehicule): Response
    {
        return $this->render('admin/flotte/enregistrement/show.html.twig', [
            'enregistrement_vehicule' => $enregistrementVehicule,
        ]);
    }

    /**
     * @Route("/enregistrement-flotte/{id}/edit", name="flotte_enregistrement_vehicule_edit", methods={"GET","POST"})
     */
    public function editEnregistrement(Request $request, EnregistrementVehicule $enregistrementVehicule): Response
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
     * @Route("/enregistrement-flotte/{id}", name="flotte_enregistrement_vehicule_delete", methods={"POST"})
     */
    public function deleteEnregistrement(Request $request, EnregistrementVehicule $enregistrementVehicule): Response
    {
        if ($this->isCsrfTokenValid('delete' . $enregistrementVehicule->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enregistrementVehicule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enregistrement_vehicule_index', [], Response::HTTP_SEE_OTHER);
    }
}
