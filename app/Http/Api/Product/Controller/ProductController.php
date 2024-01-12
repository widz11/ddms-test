<?php

namespace App\Http\Api\Product\Controller;

use App\Http\Api\Product\Repository\ProductRepository;
use App\Http\Api\Product\Resource\ProductResource;
use App\Http\Api\Base\Controller\BaseApiController;

class ProductController extends BaseApiController
{
    /**
     * Constructor
     *
     * @param ProductRepository $productRepository
     * @return void
     */
    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->repository = $productRepository;
        $this->resource = ProductResource::class;
    }

    /**
     * Return list
     *
     * @return json
     */
    public function list() {
        $isPaginate = request('is_paginate') == 'true' ? true : false;
        $pageSize = request('page_size') ? (int) request('page_size') : 10;
        $list = $this->repository->model()::query()
            ->latest();
        if($isPaginate) {
            $list = $list->paginate($pageSize);
        } else {
            $list = $list->get();
        }
        return $this->responseJsonResource($this->resource::collection($list));
    }
}