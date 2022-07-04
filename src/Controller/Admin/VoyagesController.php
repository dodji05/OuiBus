<?php

namespace App\Controller\Admin;

use App\Entity\Voyages;
use App\Form\VoyagesType;
use App\Repository\VoyagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/voyage/trip")
 */
class VoyagesController extends AbstractController
{
    /**
     * @Route("/", name="voyages_voyages_index", methods={"GET"})
     */
    public function index(VoyagesRepository $voyagesRepository): Response
    {
        return $this->render('admin/voyage/voyages/index.html.twig', [
            'voyages' => $voyagesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="voyages_voyages_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $voyage = new Voyages();
        $form = $this->createForm(VoyagesType::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($voyage);
            $entityManager->flush();
            $this->addFlash('success', 'Le voyage a été enregistrée avec success');
            return $this->redirectToRoute('voyages_voyages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/voyage/voyages/new.html.twig', [
            'voyage' => $voyage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="voyages_voyages_show", methods={"GET"})
     */
    public function show(Voyages $voyage): Response
    {
        return $this->render('admin/voyage/voyages/show.html.twig', [
            'voyage' => $voyage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="voyages_voyages_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Voyages $voyage): Response
    {
        $form = $this->createForm(VoyagesType::class, $voyage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('voyages_voyages_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/voyage/voyages/edit.html.twig', [
            'voyage' => $voyage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="voyages_voyages_delete", methods={"POST"})
     */
    public function delete(Request $request, Voyages $voyage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voyage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($voyage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('voyages_voyages_index', [], Response::HTTP_SEE_OTHER);
    }
}
