<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\FruitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class DefaultController extends AbstractController
{
    #[Route("/", name: "index")]
    #[Route("/fruits", name: "fruits")]
    #[Route("/fruits/{id}", name: "fruits_detail")]
    #[Route("/fruits/favorite", name: "fruits_favorite")]
    public function index(): Response
    {
        return $this->render('app.html.twig');
    }

    #[Route("/api/fruits", name: "api_fruits")]
    public function apiFruits(FruitRepository $fruitRepository, SerializerInterface $serializer): Response
    {
        $fruits = $fruitRepository->findAll();
        $data = $serializer->serialize($fruits, JsonEncoder::FORMAT);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }

    #[Route("/api/fruits/{id}", name: "api_fruit_detail")]
    public function apiFruitDetail(int $id, FruitRepository $fruitRepository, SerializerInterface $serializer): Response
    {
        $fruit = $fruitRepository->find($id);
        $data = $serializer->serialize($fruit, JsonEncoder::FORMAT);
        return new JsonResponse($data, Response::HTTP_OK, [], true);
    }
}
