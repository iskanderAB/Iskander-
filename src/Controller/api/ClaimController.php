<?php

namespace App\Controller\api;

use App\Entity\Claim;
use App\Entity\Survey;
use App\Repository\ClaimRepository;
use App\Repository\UserRepository;
use App\Services\TokenDecoder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @Route("/api")
 */
class ClaimController extends AbstractController
{
//    /**
//     * @Route("/claim", name="claim")
//     */
//    public function index()
//    {
//        return $this->render('claim/index.html.twig', [
//            'controller_name' => 'ClaimController',
//        ]);
//    }


    /**
     * @Route("/api/claim",name="getClaim",methods={"GET"})
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
    public function addSurvey (Request $request,SerializerInterface $serializer,EntityManagerInterface $manager){
        $data = $request->getContent();
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
