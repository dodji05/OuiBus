<?php

namespace App\Controller\Admin;

use App\Entity\Ville;
use App\Form\VilleType;
use App\Repository\VilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("voyages/ville")
 */
class VilleController extends AbstractController
{
    /**
     * @Route("/", name="voyages_ville_index", methods={"GET"})
     */
    public function index(VilleRepository $villeRepository): Response
    {
        return $this->render('admin/voyage/ville/index.html.twig', [
            'villes' => $villeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="voyages_ville_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ville = new Ville();
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ville);
            $entityManager->flush();
            $this->addFlash('success', 'La ville a été enregistrer avec success');
            return $this->redirectToRoute('voyages_ville_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/voyage/ville/new.html.twig', [
            'ville' => $ville,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="voyages_ville_show", methods={"GET"})
     */
    public function show(Ville $ville): Response
    {
        return $this->render('admin/voyage/ville/show.html.twig', [
            'ville' => $ville,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="voyages_ville_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ville $ville): Response
    {
        $form = $this->createForm(VilleType::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('voyages_ville_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/voyage/ville/edit.html.twig', [
            'ville' => $ville,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="voyages_ville_delete", methods={"POST"})
     */
    public function delete(Request $request, Ville $ville): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ville->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ville);
            $entityManager->flush();
        }

        return $this->redirectToRoute('voyages_ville_index', [], Response::HTTP_SEE_OTHER);
    }
}
