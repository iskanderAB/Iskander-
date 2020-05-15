<?php

namespace App\Controller\api;

use App\ApiModel\ClaimModel;
use App\Entity\Claim;
use App\Entity\Clean;
use App\Repository\ClaimRepository;
use App\Repository\CleanRepository;
use App\Repository\ContactRepository;
use App\Repository\ProjectRepository;
use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\File\File ;
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
     * @Route("/contac",name="getContact",methods={"GET"})
     */
    public function getContact (ContactRepository $contactRepository){
        try {
            $contact = $contactRepository->findAll();
            return $this->json($contact,200, []);
        }catch (NotEncodableValueException $exception){
            return $this->json([
                'status' => 400,
                'message' => $exception->getMessage()
            ],400);
        }
    }
    /**
     * @Route("/clean",name="getClean",methods={"GET"})
     */
    public function getClean (CleanRepository $cleanRepository){
        try {
            $clean = $cleanRepository->findAll();
            return $this->json($clean,200, []);
        }catch (NotEncodableValueException $exception){
            return $this->json([
                'status' => 400,
                'message' => $exception->getMessage()
            ],400);
        }
    }


    /**
     * @Route("/project",name="getProject",methods={"GET"})
     */
    public function getProject (ProjectRepository $projectRepository){
        try {
            $project = $projectRepository->findAll();
            return $this->json($project,200, [],["groups"=>"project_read"]);
        }catch (NotEncodableValueException $exception){
            return $this->json([
                'status' => 400,
                'message' => $exception->getMessage()
            ],400);
        }
    }

    /**
     * @Route("/articles",name="getArticle",methods={"GET"})
     */
    public function getArticles (ArticleRepository $articleRepository){
        try {
            $articles = $articleRepository->findAll();
            return $this->json($articles,200, []);
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
        try {
            /** @var ClaimModel $apiModel **/
            $apiModel = $serializer->deserialize($data,ClaimModel::class,'json');
            $fileName = uniqid().'.'.$apiModel->getExtension();
            $path = $this->getParameter("diract") .'/'.$fileName;
            file_put_contents($path,$apiModel->getEncodedData());
            $file = new File($path);
            $claim = new Claim();
            $claim ->setImage($fileName);
            $claim->setFirstName($apiModel->getFirstName());
            $claim->setLastName($apiModel->getLastName());
            $claim->setMail($apiModel->getMail());
            $claim->setTel($apiModel->getTel());
            $claim->setContent($apiModel->getContent());
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
