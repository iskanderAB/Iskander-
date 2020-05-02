<?php

namespace App\Controller\api;

use App\Entity\Claim;
use App\Repository\ClaimRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
/**
 * @Route("/api")
 */
class ApiController extends AbstractController
{
//    /**
//     * @Route("/claim", name="claim")
//     */
//    public function index()
//    {
//        return $this->render('claim/index.html.twig', [
//            'controller_name' => 'ApiController',
//        ]);
//    }

    /**
     * @Route("/claim",name="getClaim",methods={"GET"})
     */
    public function getClaim (ClaimRepository $claimRepository){
        try {
            $claim = $claimRepository->findAll();
            return $this->json($claim,200, []);
        }catch (NotEncodableValueException $exception){
            return $this->json([
                'status' => 400,
                'message' => $exception->getMessage()
            ],400);
        }
    }

    /**
     * @Route("/claim/add",name="add_claim",methods={"POST"})
     */
    public function addClaim (Request $request,SerializerInterface $serializer,EntityManagerInterface $manager){
        $data = $request->getContent();
        if ($request->headers->get('Content-type') === 'application/json'){
            dd("fuck that ") ;
        }
        try {
            $claim = $serializer->deserialize($data,Claim::class,'json');
            $manager->persist($claim);
            $manager->flush();
            return $this->json([
                'status' => 201,
                'message' => 'claim created'
            ],201);
        }catch (NotEncodableValueException $exception){
            return $this->json([
                'status' => 400,
                'message' => $exception->getMessage()
            ], 400);
        }
    }

}
