<?php

namespace App\Service;

use App\Client\BasketClient;
use App\Model\BasketData;
use App\Model\BasketDataItem;
use GRPC\Basket\BasketRequest;
use GRPC\Basket\CustomerBasketResponse;
use Psr\Log\LoggerInterface;
use Spiral\RoadRunner\GRPC\Context;

class BasketService implements BasketServiceInterface
{
    private BasketClient $basketClient;
    private LoggerInterface $logger;

    public function __construct(BasketClient $basketClient, LoggerInterface $logger)
    {
        $this->basketClient = $basketClient;
        $this->logger = $logger;
    }

    public function getById(string $id): ?BasketData
    {
        $this->logger->debug("grpc client created, request = {id}", ['id' => $id]);
        $response = $this->basketClient->GetBasketById(new Context([]), new BasketRequest(['id' => $id]));
        $this->logger->debug("grpc response (buyerId: {buyerId})", ['buyerId' => $response->getBuyerid()]);

        return $this->mapToBasketData($response);
    }

    private function mapToBasketData(CustomerBasketResponse $customerBasketRequest): ?BasketData
    {
        if ($customerBasketRequest == null) {
            return null;
        }

        $map = new BasketData();
        $map->setBuyerId($customerBasketRequest->getBuyerId());

        $itemsMap = [];
        foreach ($customerBasketRequest->getItems() as $item) {
            if ($item->getId() != null) {
                $itemMap = new BasketDataItem();
                $itemMap->setId($item->getId());
                $itemMap->setProductId($item->getProductid());
                $itemMap->setProductName($item->getProductname());
                $itemMap->setUnitPrice($item->getUnitprice());
                $itemMap->setOldUnitPrice($item->getOldunitprice());
                $itemMap->setQuantity($item->getQuantity());
                $itemMap->setPictureUrl($item->getPictureurl());
                $itemsMap[] = $itemMap;
            }
        }
        $map->setItems($itemsMap);
        return $map;
    }

}
