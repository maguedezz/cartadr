<?php

namespace App\Products\Domain\Services;

use App\App\Domain\Services\BaseService;
use App\App\Domain\Payloads\GenericPayload;
use App\Products\Domain\Scoping\Scopes\CategoryScope;
use App\Products\Domain\Repositories\ProductRepository;

class IndexProductsService extends BaseService
{
    /**
     * @var mixed
     */
    protected $products;

    /**
     * @param ProductRepository $products
     */
    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    /**
     * @param array $data
     */
    public function handle($data = [])
    {
        return new GenericPayload($this->products->with(['variations.stock'])->withScopes($this->scopes())->paginate(10));
    }

    protected function scopes()
    {
        return [
            'category' => new CategoryScope,
        ];
    }
}
