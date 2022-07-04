<?php

namespace App\Controller\Admin;

use App\Entity\Lignes;
use App\Form\LignesType;
use App\Repository\LignesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("voyages/lignes")
 */
class LignesController extends AbstractController
{
    /**
     * @Route("/", name="voyages_lignes_index", methods={"GET"})
     */
    public function index(LignesRepository $lignesRepository): Response
    {
        return $this->render('admin/voyage/lignes/index.html.twig', [
            'lignes' => $lignesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="voyages_lignes_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ligne = new Lignes();
        $form = $this->createForm(LignesType::class, $ligne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ligne);
            $entityManager->flush();

            return $this->redirectToRoute('voyages_lignes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/voyage/lignes/new.html.twig', [
            'ligne' => $ligne,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="voyages_lignes_show", methods={"GET"})
     */
    public function show(Lignes $ligne): Response
    {
        return $this->render('admin/voyage/lignes/show.html.twig', [
            'ligne' => $ligne,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="voyages_lignes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lignes $ligne): Response
    {
        $form = $this->createForm(LignesType::class, $ligne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('voyages_lignes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/voyage/lignes/edit.html.twig', [
            'ligne' => $ligne,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="voyages_lignes_delete", methods={"POST"})
     */
    public function delete(Request $request, Lignes $ligne): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ligne->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ligne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('voyages_lignes_index', [], Response::HTTP_SEE_OTHER);
    }
}
