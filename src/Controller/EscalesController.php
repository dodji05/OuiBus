<?php

namespace App\Controller;

use App\Entity\Escales;
use App\Form\EscalesType;
use App\Repository\EscalesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/escales")
 */
class EscalesController extends AbstractController
{
    /**
     * @Route("/", name="escales_index", methods={"GET"})
     */
    public function index(EscalesRepository $escalesRepository): Response
    {
        return $this->render('escales/index.html.twig', [
            'escales' => $escalesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="escales_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $escale = new Escales();
        $form = $this->createForm(EscalesType::class, $escale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($escale);
            $entityManager->flush();

            return $this->redirectToRoute('escales_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('escales/new.html.twig', [
            'escale' => $escale,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="escales_show", methods={"GET"})
     */
    public function show(Escales $escale): Response
    {
        return $this->render('escales/show.html.twig', [
            'escale' => $escale,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="escales_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Escales $escale): Response
    {
        $form = $this->createForm(EscalesType::class, $escale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('escales_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('escales/edit.html.twig', [
            'escale' => $escale,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="escales_delete", methods={"POST"})
     */
    public function delete(Request $request, Escales $escale): Response
    {
        if ($this->isCsrfTokenValid('delete'.$escale->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($escale);
            $entityManager->flush();
        }

        return $this->redirectToRoute('escales_index', [], Response::HTTP_SEE_OTHER);
    }
}
