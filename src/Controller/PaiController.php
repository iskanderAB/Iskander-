<?php

namespace App\Controller;

use App\Entity\Pai;
use App\Form\PaiType;
use App\Repository\PaiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pai")
 */
class PaiController extends AbstractController
{
    /**
     * @Route("/", name="pai_index", methods={"GET"})
     */
    public function index(PaiRepository $paiRepository): Response
    {
        return $this->render('pai/index.html.twig', [
            'pais' => $paiRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pai_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pai = new Pai();
        $form = $this->createForm(PaiType::class, $pai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pai);
            $entityManager->flush();

            return $this->redirectToRoute('pai_index');
        }

        return $this->render('pai/new.html.twig', [
            'pai' => $pai,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pai_show", methods={"GET"})
     */
    public function show(Pai $pai): Response
    {
        return $this->render('pai/show.html.twig', [
            'pai' => $pai,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pai_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pai $pai): Response
    {
        $form = $this->createForm(PaiType::class, $pai);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pai_index');
        }

        return $this->render('pai/edit.html.twig', [
            'pai' => $pai,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pai_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pai $pai): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pai->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pai);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pai_index');
    }
}
