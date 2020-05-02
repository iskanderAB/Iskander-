<?php

namespace App\Controller;

use App\Entity\Claim;
use App\Form\ClaimType;
use App\Repository\ClaimRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/claim")
 */
class ClaimController extends AbstractController
{
    /**
     * @Route("/", name="claim_index", methods={"GET"})
     */
    public function index(ClaimRepository $claimRepository): Response
    {
        return $this->render('claim/index.html.twig', [
            'claims' => $claimRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="claim_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $claim = new Claim();
        $form = $this->createForm(ClaimType::class, $claim);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($claim);
            $entityManager->flush();

            return $this->redirectToRoute('claim_index');
        }

        return $this->render('claim/new.html.twig', [
            'claim' => $claim,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="claim_show", methods={"GET"})
     */
    public function show(Claim $claim): Response
    {
        return $this->render('claim/show.html.twig', [
            'claim' => $claim,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="claim_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Claim $claim): Response
    {
        $form = $this->createForm(ClaimType::class, $claim);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('claim_index');
        }

        return $this->render('claim/edit.html.twig', [
            'claim' => $claim,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="claim_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Claim $claim): Response
    {
        if ($this->isCsrfTokenValid('delete'.$claim->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($claim);
            $entityManager->flush();
        }

        return $this->redirectToRoute('claim_index');
    }
}
