<?php

namespace App\Categories\Domain\Services;

use App\App\Domain\Payloads\GenericPayload;
use App\App\Domain\Services\BaseService;
use App\Categories\Domain\Repositories\CategoryRepository;

class IndexCategoriesService extends BaseService
{
    protected $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }
    public function handle($data = [])
    {
        return new GenericPayload($this->categories->with('children')->parents()->ordered()->get());
    }

}