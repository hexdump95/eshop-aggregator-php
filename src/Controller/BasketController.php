<?php

namespace App\Controller;

use App\Model\BasketData;
use App\Model\UpdateBasketRequest;
use App\Service\BasketService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/v1/basket')]
class BasketController extends AbstractController
{
    private BasketService $basketService;
    private SerializerInterface $serializer;
    private LoggerInterface $logger;

    public function __construct(BasketService $basketService, SerializerInterface $serializer, LoggerInterface $logger)
    {
        $this->basketService = $basketService;
        $this->serializer = $serializer;
        $this->logger = $logger;
    }

    #[Route('', name: 'update_all_basket', methods: ['POST', 'PUT'])]
    public function updateAllBasket(Request $request): JsonResponse
    {
        $data = $this->serializer->deserialize($request->getContent(), UpdateBasketRequest::class, 'json');

        if (empty($data->getItems())) {
            return new JsonResponse(["Need to pass at least one basket line"], Response::HTTP_BAD_REQUEST);
        }

        $basket = $this->basketService->getById($data->getBuyerId());
        if ($basket->getBuyerId() == null) {
            $basket = new BasketData();
            $basket->setBuyerId($data->getBuyerId());
        }

        // TODO: get catalogItems from catalog service
        $catalogItems = [];

        // TODO: update basket from basket service

        $jsonResponse = $this->serializer->serialize($basket, 'json');
        return new JsonResponse($jsonResponse, 200, [], true);
    }

}
