<?php

namespace App\Products\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\BaseService;



class ShowProductService extends BaseService
{
    public function handle($product = null)
    {
       $product->load(['variations.type','variations.stock','variations.product']);
        return new GenericPayload($product);
    }
}