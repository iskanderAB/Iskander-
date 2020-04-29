<?php

namespace App\Controller;

use App\Entity\Clean;
use App\Form\CleanType;
use App\Repository\CleanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/clean")
 */
class CleanController extends AbstractController
{
    /**
     * @Route("/", name="clean_index", methods={"GET"})
     */
    public function index(CleanRepository $cleanRepository): Response
    {
        return $this->render('clean/index.html.twig', [
            'cleans' => $cleanRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="clean_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $clean = new Clean();
        $form = $this->createForm(CleanType::class, $clean);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $File = $form->get('image')->getData();
            if ($File) {
                $originalFilename = pathinfo($File->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $originalFilename ;
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $File->guessExtension();
                try {
                    $File->move(
                        $this->getParameter('diract'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    dd("es2l iskander AB  ") ;
                }
            }
            $clean->setImage($newFilename);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($clean);
            $entityManager->flush();
            return $this->redirectToRoute('clean_index');
        }
        return $this->render('clean/new.html.twig', [
            'clean' => $clean,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="clean_show", methods={"GET"})
     */
    public function show(Clean $clean): Response
    {
        return $this->render('clean/show.html.twig', [
            'clean' => $clean,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="clean_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Clean $clean): Response
    {
        $form = $this->createForm(CleanType::class, $clean);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('clean_index');
        }

        return $this->render('clean/edit.html.twig', [
            'clean' => $clean,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="clean_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Clean $clean): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clean->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($clean);
            $entityManager->flush();
        }

        return $this->redirectToRoute('clean_index');
    }
}
