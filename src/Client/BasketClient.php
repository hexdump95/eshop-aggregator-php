<?php

namespace App\Client;

use Exception;
use Grpc\BaseStub;
use GRPC\Basket\BasketInterface;
use GRPC\Basket\BasketRequest;
use GRPC\Basket\CustomerBasketRequest;
use GRPC\Basket\CustomerBasketResponse;
use Grpc\ChannelCredentials;
use Psr\Log\LoggerInterface;
use Spiral\RoadRunner\GRPC;

final class BasketClient extends BaseStub implements BasketInterface
{
    public function __construct($hostname, LoggerInterface $logger)
    {
        try {
            parent::__construct(
                $hostname,
                ['credentials' => ChannelCredentials::createInsecure()],
            );
        } catch (Exception $e) {
            $logger->error($e->getMessage());
        }
    }

    public function GetBasketById(GRPC\ContextInterface $ctx, BasketRequest $in): CustomerBasketResponse
    {
        [$response] = $this->_simpleRequest(
            '/' . self::NAME . '/GetBasketById',
            $in,
            [CustomerBasketResponse::class, 'decode'],
            (array)$ctx->getValue('metadata'),
            (array)$ctx->getValue('options')
        )->wait();
        return $response;
    }

    public function UpdateBasket(GRPC\ContextInterface $ctx, CustomerBasketRequest $in): CustomerBasketResponse
    {
        [$response] = $this->_simpleRequest(
            '/' . self::NAME . '/UpdateBasket',
            $in,
            [CustomerBasketResponse::class, 'decode'],
            (array)$ctx->getValue('metadata'),
            (array)$ctx->getValue('options')
        )->wait();

        return $response;
    }
}
