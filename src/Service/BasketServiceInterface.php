<?php

namespace App\Service;

use App\Model\BasketData;

interface BasketServiceInterface
{
    function getById(string $id): ?BasketData;
}
